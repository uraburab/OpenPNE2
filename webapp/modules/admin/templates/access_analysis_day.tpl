({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({*<div class="tree"><a href="?m=({$module_name})">管理画面TOP</a>&nbsp;＞&nbsp;セキュリティ管理：ページ名ランダム生成</div>*})

({if $item_str == "PC版"})
({assign var="parent_page_name" value="PCページ月次集計"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_month')})&ktai_flag=0({/capture})
({else})
({assign var="parent_page_name" value="携帯ページ月次集計"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_month')})&ktai_flag=1({/capture})
({/if})


({capture name=page_name_temp})({$item_str}) 日次ページビュー集計({/capture})
({assign var="page_name" value=$smarty.capture.page_name_temp})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

<h2>({$item_str}) 日次ページビュー集計</h2>
<div class="contents">
({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})


<table class="basicType2">
({foreach from=$access_analysis_day item=item})
<tr>

<td>
({$item.ymd|date_format:"%d日"})
</td>

<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_page')})&ymd=({$item.ymd})&month_flag=0&ktai_flag=({$ktai_flag})">({$item.count})</a>
</td>

</tr>
({/foreach})
</table>
({$inc_footer|smarty:nodefaults})
