<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_c_topic_write_confirm extends OpenPNE_Action
{
    function handleError($errors)
    {
        $_REQUEST['err_msg'] = $errors;
        openpne_forward('pc', 'page', 'c_topic_detail', $errors);
        exit;
    }

    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $body = $requests['body'];
        $button = $requests['button'];
        // ----------

        //TODO:画像バリデータ
        $upfile_obj1 = $_FILES['image_filename1'];
        $upfile_obj2 = $_FILES['image_filename2'];
        $upfile_obj3 = $_FILES['image_filename3'];

        //エラーチェック
        $err_msg = array();

        if (empty($upfile_obj1) && $upfile_obj1['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj1))) {
                $err_msg[] = '画像1は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
            }
        }
        if (empty($upfile_obj2) && $upfile_obj2['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj2))) {
                $err_msg[] = '画像2は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
            }
        }
        if (empty($upfile_obj3) && $upfile_obj3['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj3))) {
                $err_msg[] = '画像3は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
            }
        }

        if ($err_msg) {
            $_REQUEST['err_msg'] = $err_msg;
            openpne_forward('pc', 'page', "c_topic_detail");
            exit;
        }
        //-----

        $c_topic = c_topic_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];

        //--- 権限チェック
        if (!db_commu_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        $sessid = session_id();
        t_image_clear_tmp($sessid);
        $tmpfile1 = t_image_save2tmp($upfile_obj1, $sessid, "tc_1");
        $tmpfile2 = t_image_save2tmp($upfile_obj2, $sessid, "tc_2");
        $tmpfile3 = t_image_save2tmp($upfile_obj3, $sessid, "tc_3");

        $this->set('inc_navi', fetch_inc_navi('c', $c_commu_id));
        $topic_write['target_c_commu_topic_id'] = $c_commu_topic_id;
        $topic_write['body'] = $body;
        $topic_write['image_filename1_tmpfile']=$tmpfile1;
        $topic_write['image_filename2_tmpfile']=$tmpfile2;
        $topic_write['image_filename3_tmpfile']=$tmpfile3;
        $topic_write['image_filename1']=$upfile_obj1["name"];
        $topic_write['image_filename2']=$upfile_obj2["name"];
        $topic_write['image_filename3']=$upfile_obj3["name"];
        $this->set('topic_write', $topic_write);
        return 'success';
    }
}

?>
