<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_do_o_regist_pc_mail extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function handleError($errors)
    {
        unset($_REQUEST['password']);

        $_REQUEST['msg'] = array_shift($errors);
        openpne_forward('pc', 'page', 'o_regist_pc_mail');

        exit;
    }

    function execute($requests)
    {

        // 外部認証の場合はリダイレクト
        check_action4pne_slave(false);

        // --- リクエスト変数
        $ktai_address = $requests['ktai_address'];
        $password = $requests['password'];
        $pc_address = $requests['pc_address'];
        $pc_address2 = $requests['pc_address2'];
        // ----------

        $errors = array();
        @session_start();
        if (OPENPNE_USE_CAPTCHA && (empty($_SESSION['captcha_keystring'])
            || $_SESSION['captcha_keystring'] !=  $requests['captcha'])
        ) {
            unset($_SESSION['captcha_keystring']);
            $errors[] = "確認キーワードが誤っています";
        } else {
            if (!$c_member_id = db_member_is_ktai_address_password_complete($ktai_address, $password)) {
                $errors[] = '登録済み携帯アドレス、またはパスワードに正しい値を入力してください';
            }
            if (!db_common_is_mailaddress($pc_address)
                || is_ktai_mail_address($pc_address)) {
                $errors[] = 'PCメールアドレスを正しく入力してください';
            }
            if (db_member_c_member_id4pc_address($pc_address)) {
                $errors[] = '入力されたメールアドレスは既に登録されています';
            }
            if ($pc_address !== $pc_address2) {
                $errors[] = 'メールアドレスが一致しません';
            }
            if (!db_member_is_limit_domain4mail_address($pc_address)) {
                $errors[] = '入力したメールアドレスでは登録できません';
            }
        }
        if ($errors) {
            $this->handleError($errors);
        }

        // PCメール登録処理 
        db_member_h_config_1($c_member_id, $pc_address);

        openpne_redirect('pc', 'page_o_regist_pc_mail_end');
    }
}

?>
