<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

/**
 * コミュニティ管理者交代依頼メッセージ送信
 */
class pc_do_h_home_update_my_news extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $prof_my_news = $requests['prof_my_news'];
        // ----------
        
        db_member_update_c_profile_my_news($u, $prof_my_news, date('Y-m-d H:i:s'));
        
        //--- 権限チェック
        //なし
        
        openpne_redirect('pc', 'page_h_home', array());
    }
}
?>
