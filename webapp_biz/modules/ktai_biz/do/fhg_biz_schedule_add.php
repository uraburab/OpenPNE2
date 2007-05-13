<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_biz_do_fhg_biz_schedule_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        $tail = $GLOBALS['KTAI_URL_TAIL'];

        //target_idã®æE®
        if (!$requests['target_id']) {
            $requests['target_id'] = $u;
        }
        
        $requests['sc_b_year'] = $requests['sc_b_year'] + 2000;

        $biz_schedule_member = array();
 
        // èªåEEäºå®ãEå ´åãEèªåEEã¿ãåå èE¨ãã
        if ($requests['sc_j_mem'] == 'my') {
            $biz_schedule_member = array($requests['target_id']);
        }

        //ERROR----------------
        //å­å¨ããªãE¥ä»
        if (!checkdate($requests['sc_b_month'], $requests['sc_b_date'], $requests['sc_b_year'])) {
            $redirect_script = '?m=ktai_biz&a=page_fh_biz_schedule_add&'.$tail;
            $msg = 'å­å¨ããªãE¥ä»ãæE®ããã¾ãããE;

            //æ¥ä»é¢é£ã®å¼æ°ã¯è¿ããªãã¦ããã
            $url = $redirect_script.
                        '&msg='.$msg.
                        '&title='.$requests['sc_title'].
                        '&sc_rp='.$requests['sc_rp'].
                        '&sc_memo='.$requests['sc_memo'].
                        '&biz_group_id='.serialize($requests['biz_group_id']).
                        '&sc_rwk_enc='.serialize($requests['sc_rwk_enc']).
                        '&sc_rcount='.$requests['sc_rcount'].
                        '&target_id='.$requests['target_id'];

            $_REQUEST['sc_title'] = $requests['sc_title'];
            $_REQUEST['sc_rp'] = $requests['sc_rp'];
            $_REQUEST['sc_memo'] = $requests['sc_memo'];
            $_REQUEST['biz_group_id'] = serialize($requests['biz_group_id']);
            $_REQUEST['sc_rwk_enc'] = serialize($requests['sc_rwk_enc']);
            $_REQUEST['sc_rcount'] = $requests['sc_rcount'];
            $_REQUEST['target_id'] = $requests['target_id'];


            $_REQUEST['msg'] = 'å­å¨ããªãE¥ä»ãæE®ããã¾ãããE;
            openpne_forward('ktai_biz', 'page', "fh_biz_schedule_add");
            exit;
        }
        //---------------------

        //ERROR----------------
        //ã¿ã¤ãã«æªå¥å
        if (empty($requests['sc_title'])) {
            $redirect_script = '?m=ktai_biz&a=page_fh_biz_schedule_add&'.$tail;
            $msg = 'ã¿ã¤ãã«ãåEåãã¦ãã ãããE;
            $begin_date = $requests['sc_b_year'].'-'.$requests['sc_b_month'].'-'.$requests['sc_b_date'];
            $begin_time = $requests['sc_b_hour'].':'.$requests['sc_b_minute'];
            $finish_time = $requests['sc_f_hour'].':'.$requests['sc_f_minute'];
            $url = $redirect_script.
                        '&msg='.$msg.
                        '&begin_date='.$begin_date.
                        '&begin_time='.$begin_time.
                        '&finish_time='.$finish_time.
                        '&sc_rp='.$requests['sc_rp'].
                        '&sc_memo='.$requests['sc_memo'].
                        '&biz_group_id='.serialize($requests['biz_group_id']).
                        '&sc_rwk_enc='.serialize($requests['sc_rwk_enc']).
                        '&sc_rcount='.$requests['sc_rcount'].
                        '&target_id='.$requests['target_id'];

            $_REQUEST['begin_date'] = $begin_date;
            $_REQUEST['begin_time'] = $begin_time;
            $_REQUEST['finish_time'] = $finish_time;
            $_REQUEST['sc_rp'] = $requests['sc_rp'];
            $_REQUEST['sc_memo'] = $requests['sc_memo'];
            $_REQUEST['biz_group_id'] = serialize($requests['biz_group_id']);
            $_REQUEST['sc_rwk_enc'] = serialize($requests['sc_rwk_enc']);
            $_REQUEST['sc_rcount'] = $requests['sc_rcount'];
            $_REQUEST['target_id'] = $requests['target_id'];
            $_REQUEST['msg'] = 'ã¿ã¤ãã«ãåEåãã¦ãã ãããE;
            openpne_forward('ktai_biz', 'page', "fh_biz_schedule_add");
            exit;
        }   
        //---------------------

        //æ¥ä»ãEãã©ã¼ããããè¨­å®
        $begin_date = $requests['sc_b_year'].'-'.$requests['sc_b_month'].'-'.$requests['sc_b_date'];

        $begin_time = $requests['sc_b_hour'].':'.$requests['sc_b_minute'];
        $finish_time = $requests['sc_f_hour'].':'.$requests['sc_f_minute'];

        //ERROR---------------
        if ((strtotime($finish_time) < strtotime($begin_time)) && ($finish_time != ':')) {
            //çµäºEéã¨éå§æéãå¤
            $redirect_script = '?m=ktai_biz&a=page_fh_biz_schedule_add&'.$tail;
            $msg = 'çµäºEå»ãéå§æå»ããåã§ããE;
            $begin_date = $requests['sc_b_year'].'-'.$requests['sc_b_month'].'-'.$requests['sc_b_date'];
            $begin_time = $requests['sc_b_hour'].':'.$requests['sc_b_minute'];
            $finish_time = $requests['sc_f_hour'].':'.$requests['sc_f_minute'];
            $url = $redirect_script.
                        '&msg='.$msg.
                        '&begin_date='.$begin_date.
                        '&sc_title='.$requests['sc_title'].
                        '&sc_rp='.$requests['sc_rp'].
                        '&sc_memo='.$requests['sc_memo'].
                        '&biz_group_id='.serialize($requests['biz_group_id']).
                        '&sc_rwk_enc='.serialize($requests['sc_rwk_enc']).
                        '&sc_rcount='.$requests['sc_rcount'].
                        '&target_id='.$requests['target_id'];

            $_REQUEST['begin_date'] = $begin_date;
            $_REQUEST['sc_title'] = $requests['sc_title'];
            $_REQUEST['sc_rp'] = $requests['sc_rp'];
            $_REQUEST['sc_memo'] = $requests['sc_memo'];
            $_REQUEST['biz_group_id'] = serialize($requests['biz_group_id']);
            $_REQUEST['sc_rwk_enc'] = serialize($requests['sc_rwk_enc']);
            $_REQUEST['sc_rcount'] = $requests['sc_rcount'];
            $_REQUEST['target_id'] = $requests['target_id'];

            $_REQUEST['msg'] = 'çµäºEå»ãéå§æå»ããåã§ããE;
            openpne_forward('ktai_biz', 'page', "fh_biz_schedule_add");
            exit;
        }
        //--------------------

        $finish_date = $begin_date;

        if (!($requests['sc_b_hour'] || $requests['sc_b_minute'] || $requests['sc_f_hour'] || $requests['sc_f_minute'])) {
            //æå»æE®ãªã
            $begin_time = $finish_time = null;
        } elseif (!($requests['sc_f_hour'] || $requests['sc_f_minute'])) {
            $finish_time = null;
        }

        if (!$requests['sc_rp']) {
            //ç¹°ãè¿ããããªãEºå®ç»é²
            biz_insertSchedule($requests['sc_title'], $u, $begin_date, $finish_date, $begin_time, $finish_time, $requests['sc_memo'], $rp_rule, 0, $requests['biz_group_id'], $requests['public_flag'], $biz_schedule_member);
        } else {
            //ç¹°ãè¿ãäºå®
            $tmp = $begin_date;  //å¦çE¸­ã®æ¥ä»

            for ($i=0; date("Ymd", strtotime($tmp)) < date("Ymd", strtotime($finish_date)); $i++) {
                $nowday = strtotime($requests['sc_b_year'].'-'.$requests['sc_b_month'].'-'.($requests['sc_b_date']+$i));
                $tmp = date("Ymd", $nowday);
                if ($rp_rule & (1 << date("w",$nowday))) {
                    biz_insertSchedule($requests['sc_title'], $u, $tmp, $tmp, $begin_time, $finish_time, $requests['sc_memo'], $rp_rule, $first_id, $requests['biz_group_id'], $requests['public_flag'], $biz_schedule_member);
                }
            }
        }

        $week = date("W", abs(strtotime($begin_date)-strtotime(date("Y-m-d"))))-1;
        $target_id = $requests['target_id'];
        $_REQUEST['msg'] = 'äºå®ãè¿½å ãã¾ãããE;
        $_REQUEST['w'] = $week;
        $_REQUEST['target_id'] = $target_id;
        $_REQUEST['id'] = biz_getScheduleMax();
        openpne_forward('ktai_biz', 'page', "fh_calendar_week");
        exit;
    }
}

?>
