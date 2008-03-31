<div id="LayoutC">
({ext_include file="inc_c_com_topic_find.tpl"})

<div id="Center">

({if !$err_msg})

({* {{{ infoBox *})
<div class="dparts infoBox"><div class="parts">
<p>このイベントを({$WORD_MY_FRIEND})に教える</p>
<ul class="moreInfo">
<li><a href="({t_url m=pc a=page_c_event_invite})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})">イベントお知らせメッセージ</a></li>
</ul>
</div></div>
({* }}} *})

({* {{{ eventDetailBox *})
<!-- ******ここから：イベント詳細****** -->
<div class="dparts eventDetailBox"><div class="parts">
<div class="partsHeading"><h3>[({$c_commu.name})] イベント</h3></div>

<dl>
<dt>({$c_topic.r_datetime|date_format:"%Y年%m月%d日<br />%H:%M"})</dt>
<dd>
({if $c_topic.image_filename1||$c_topic.image_filename2||$c_topic.image_filename3})
<ul class="photo">
({if $c_topic.image_filename1})<li><a href="({t_img_url filename=$c_topic.image_filename1})" target="_blank"><img src="({t_img_url filename=$c_topic.image_filename1 w=120 h=120})" alt="" /></a></li>({/if})
({if $c_topic.image_filename2})<li><a href="({t_img_url filename=$c_topic.image_filename2})" target="_blank"><img src="({t_img_url filename=$c_topic.image_filename2 w=120 h=120})" alt="" /></a></li>({/if})
({if $c_topic.image_filename3})<li><a href="({t_img_url filename=$c_topic.image_filename3})" target="_blank"><img src="({t_img_url filename=$c_topic.image_filename3 w=120 h=120})" alt="" /></a></li>({/if})
</ul>
({/if})

<table><tr>
<th>タイトル</th>
<td>({$c_topic.name})</td>
</tr><tr>
<th>作成者</th>
<td><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_topic.c_member_id})">({$c_topic.nickname})</a></td>
</tr><tr>
<th>開催日時</th>
<td>({$c_topic.open_date})&nbsp;({$c_topic.open_date_comment})</td>
</tr><tr>
<th>開催場所</th>
<td>({$c_topic.pref})({$c_topic.open_pref_comment})</td>
</tr><tr>
<th>関連コミュニティ</th>
<td><a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$c_commu.c_commu_id})">({$c_commu.name})</a></td>
</tr><tr>
<th>詳細</th>
<td>({$c_topic.body|nl2br|t_url2cmd:'community'|t_cmd:'community'})</td>
</tr><tr>
<th>募集期限</th>
<td>({if $c_topic.invite_period != "0000-00-00"})({$c_topic.invite_period})({else})指定なし({/if})</td>
</tr><tr>
<th>募集人数</th>
<td>({if $c_topic.capacity})({$c_topic.capacity})人({else})無制限({/if})</td>
</tr><tr>
<th>参加者</th>
<td>({$c_topic.member_num})人
<ul class="moreInfo"><li>({if $c_topic.member_num})<img src="./skin/dummy.gif" alt="dummy" class="icon arrow_1" /><a href="({t_url m=pc a=page_c_event_member_list})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})">参加者一覧を見る</a>({/if})</li></ul>
</td>
</tr><tr>
<th>一括メッセージ</th>
<td>イベント参加者に一括メッセージを送ります。
<ul class="moreInfo"><li><img src="./skin/dummy.gif" alt="dummy" class="icon arrow_1" /><a href="({t_url m=pc a=page_c_event_mail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})">一括メッセージを送る</a></li></ul>
</td>
</tr></table>
</dd>
</dl>

<div class="operation">
({t_form_block m=pc a=page_c_event_edit})
<input type="hidden" name="target_c_commu_topic_id" value="({$c_topic.c_commu_topic_id})" />
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="編集" /></li>
</ul>
({/t_form_block})
</div>

</div></div>
<!-- ******ここまで：イベント詳細****** -->
({* }}} *})

({if $c_topic_write.0})
({* {{{ commentList *})
<div class="dparts commentList"><div class="parts">
<div class="partsHeading"><h3>書き込み</h3></div>
<div class="pagerRelative">
({if $all})
<p><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})">最新を表示</a></p>
({elseif $total_num > $page_size})
<p><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})&amp;all=1">すべて表示</a></p>
({/if})
({if $is_next})<p class="prev"><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})&amp;direc=1&amp;page=({$page})#comments">＜前</a></p>({/if})
<p class="number">({$start_num})番～({$end_num})番を表示</p>
({if $is_prev})<p class="next"><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})&amp;direc=-1&amp;page=({$page})#comments">次＞</a></p>({/if})
</div>
({foreach from=$c_topic_write item=item})
<dl>
<dt>({$item.r_datetime|date_format:"%Y年<br />%m月%d日<br />%H:%M"})</dt>
<dd>
<div class="title">
<p class="heading"><strong>({$item.number})</strong>: <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname})</a>({if $c_member_id == $item.c_member_id || $c_member_id == $c_commu.c_member_id_admin || $c_member_id == $c_commu.c_member_id_sub_admin}) <a href="({t_url m=pc a=page_c_event_write_delete_confirm})&amp;target_c_commu_topic_comment_id=({$item.c_commu_topic_comment_id})">削除</a>({/if})</p>
</div>
<div class="body">
({if $item.image_filename1 || $item.image_filename2 || $item.image_filename3})
<ul class="photo">
({if $item.image_filename1})<li><a href="({t_img_url filename=$item.image_filename1})" target="_blank"><img src="({t_img_url filename=$item.image_filename1 w=120 h=120})" alt="" /></a></li>({/if})
({if $item.image_filename2})<li><a href="({t_img_url filename=$item.image_filename2})" target="_blank"><img src="({t_img_url filename=$item.image_filename2 w=120 h=120})" alt="" /></a></li>({/if})
({if $item.image_filename3})<li><a href="({t_img_url filename=$item.image_filename3})" target="_blank"><img src="({t_img_url filename=$item.image_filename3 w=120 h=120})" alt="" /></a></li>({/if})
</ul>
({/if})
<p class="text">({$item.body|nl2br|t_url2cmd:'community'|t_cmd:'community'})</p>
</div>
</dd>
</dl>
({/foreach})
<div class="pagerRelative">
({if $all})
<p><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})">最新を表示</a></p>
({elseif $total_num > $page_size})
<p><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})&amp;all=1">すべて表示</a></p>
({/if})
({if $is_next})<p class="prev"><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})&amp;direc=1&amp;page=({$page})#comments">＜前</a></p>({/if})
<p class="number">({$start_num})番～({$end_num})番を表示</p>
({if $is_prev})<p class="next"><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})&amp;direc=-1&amp;page=({$page})#comments">次＞</a></p>({/if})
</div>
</div></div>
({* }}} *})
({/if})

({/if})

({if $is_c_commu_member})
({* {{{ formTable *})
<div class="dparts formTable" id="commentForm"><div class="parts">
<div class="partsHeading"><h3>新しく書き込む</h3></div>
({t_form_block _enctype=file m=pc a=page_c_event_write_confirm})
<input type="hidden" name="target_c_commu_topic_id" value="({$c_topic.c_commu_topic_id})" />
<table>
<tr><th>本文</th><td><textarea name="body" rows="10" cols="50">({$body})</textarea></td></tr>
<tr><th>写真1</th><td><input type="file" class="input_file" name="image_filename1" size="40" /></td></tr>
<tr><th>写真2</th><td><input type="file" class="input_file" name="image_filename2" size="40" /></td></tr>
<tr><th>写真3</th><td><input type="file" class="input_file" name="image_filename3" size="40" /></td></tr>
</table>
<div class="operation">
<ul class="moreInfo button">
({strip})
({if $is_event_join_date})
    ({if $is_c_event_member})
        <li><input type="submit" class="input_submit" name="button" value="参加をキャンセルする" /></li>
    ({elseif !$c_topic.capacity || ($c_topic.capacity > $c_topic.member_num)}) 
        <li><input type="submit" class="input_submit" name="button" value="イベントに参加する" /></li>
    ({/if})
({/if})
({/strip})
<li><input type="submit" class="input_submit" name="button" value="コメントのみ書き込む" /></li>
</ul>
</div>
({/t_form_block})
</div></div>
({* }}} *})
({/if})

({* {{{ *})
({* #1939 *})<div class="parts">
({* #1939 *})<img src="./skin/dummy.gif" alt="dummy" class="icon arrow_1" />
({* #1939 *})<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$c_commu.c_commu_id})">[({$c_commu.name})]コミュニティトップへ</a>
({* #1939 *})</div>
({* }}} *})

</div><!-- Center -->
</div><!-- LayoutC -->
