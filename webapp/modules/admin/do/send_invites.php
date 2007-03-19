<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 招待メール一括送信
class admin_do_send_invites extends OpenPNE_Action
{
    function execute($requests)
    {
        $module_name = ADMIN_MODULE_NAME;

        if ($requests['input'] || empty($requests['mails'])) {
            openpne_forward($module_name, 'page', 'send_invites');
            exit;
        }

        $mails = $requests['mails'];
        $mails = str_replace("\r\n", "\n", $mails);
        $mails = str_replace("\r", "\n", $mails);
        $mail_list = explode("\n", $mails);

        // filtering
        $errors = array();
        $pcs = array();
        $ktais = array();
        $limits = array();

        foreach ($mail_list as $mail) {
            // メールアドレスとして正しくない
            if (!db_common_is_mailaddress($mail)) {
                continue;
            }


            if (db_member_is_sns_join4mail_address($mail)) { // 登録済み
                $errors[] = $mail;
            } elseif (!db_member_is_limit_domain4mail_address($mail)) { // ドメイン制限
                $limits[] = $mail;
            } elseif (db_is_c_black_list($mail)) {
                $blacks[] = $mail;
            } elseif (is_ktai_mail_address($mail)) {
                $ktais[] = $mail;
            } else {
                $pcs[] = $mail;
            }
        }

        if (empty($requests['complete'])) {
            // 確認画面へ
            $_REQUEST['error_mails'] = $errors;
            $_REQUEST['pc_mails'] = $pcs;
            $_REQUEST['ktai_mails'] = $ktais;
            $_REQUEST['limit_domain_mails'] = $limits;
            $_REQUEST['black_list_mails'] = $blacks;
            openpne_forward($module_name, 'page', 'send_invites_confirm');
            exit;

        } else {
            // 送信者はとりあえず1番で固定
            $c_member_id_invite = 1;

            //<PCKTAI
            if (!defined('OPENPNE_REGIST_FROM') ||
                    (OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_KTAI) >> 1) {
                foreach ($ktais as $mail) {
                    // 携帯へ招待メール
                    $session = create_hash();

                    // c_member_ktai_pre に追加
                    if (db_member_c_member_ktai_pre4ktai_address($mail)) {
                        db_member_update_c_member_ktai_pre($session, $mail, $c_member_id_invite);
                    } else {
                        db_member_insert_c_member_ktai_pre($session, $mail, $c_member_id_invite);
                    }

                    h_invite_insert_c_invite_mail_send($session, $c_member_id_invite, $mail, $requests['message']);
                }
            }
            //>

            //<PCKTAI
            if (!defined('OPENPNE_REGIST_FROM') ||
                    (OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_PC)) {

                // PCへ招待メール
                foreach ($pcs as $mail) {
                    $session = create_hash();

                    // c_member_pre に追加
                    if (db_member_c_member_pre4pc_address($mail)) {
                        db_member_update_c_invite($c_member_id_invite, $mail, $requests['message'], $session);
                    } else {
                        db_member_insert_c_invite($c_member_id_invite, $mail, $requests['message'], $session);
                    }

                    do_h_invite_insert_c_invite_mail_send($c_member_id_invite, $session, $requests['message'], $mail);
                }
            }
            //>

            admin_client_redirect('top', '招待メールを送信しました');
        }
    }
}

?>
