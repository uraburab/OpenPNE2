<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// ユーザー強制退会
class admin_do_delete_c_member extends OpenPNE_Action
{
    function execute($requests)
    {

        if (SEND_USER_DATA) {
            //退会完了メール送信(管理者宛)
            do_common_send_mail_taikai4admin($requests['target_c_member_id'], '');
        }

        db_common_delete_c_member($requests['target_c_member_id']);

        admin_client_redirect('top', 'ユーザーの強制退会を完了しました');
    }
}

?>
