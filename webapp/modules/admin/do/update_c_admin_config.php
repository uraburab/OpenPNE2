<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// SNS設定変更
class admin_do_update_c_admin_config extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('edit_c_admin_config', '正しく入力してください');
    }
    function execute($requests)
    {
        $config =& OpenPNE_Config::getInstance();

        if (!$requests['OPENPNE_ENABLE_KTAI'] && $requests['OPENPNE_KTAI_ID_REQUIRED']) {
        	admin_client_redirect('edit_c_admin_config', '携帯版が使用可でなければ携帯固有番号は必須にできません');
        }
        foreach ($requests as $name => $value) {
            if (!$config->is_allowed($name)) continue;

            // 配列の場合はカンマ区切りに
            if (is_array($value)) {
                $value = implode(',', $value);
            }

            if (is_null(db_admin_c_admin_config4name($name))) {
                db_admin_insert_c_admin_config($name, $value);
            } else {
                db_admin_update_c_admin_config($name, $value);
            }
        }

        admin_client_redirect('edit_c_admin_config', '設定を変更しました');
    }
}

?>
