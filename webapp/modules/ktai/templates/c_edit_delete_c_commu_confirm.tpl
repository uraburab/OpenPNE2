({$inc_ktai_header|smarty:nodefaults})

<table width="100%"><tr><td align="center" bgcolor="#({$ktai_color_config.bg_02})">
<font color="#({$ktai_color_config.font_05})"><a name="top">({$c_commu.name})</a></font><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_03})" align="center">
ｺﾐｭﾆﾃｨの削除<br>
</td></tr></table>
<br>
このｺﾐｭﾆﾃｨを本当に削除しますか?<br>

<hr color="#({$ktai_color_config.border_01})">
<center>
({t_form m=ktai a=do_c_edit_delete_c_commu})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_commu_id" value="({$c_commu_id})">
<input type="submit" value="　は　い　"><br>
</form>

({t_form _method=get m=ktai a=page_c_edit})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_commu_id" value="({$c_commu_id})">
<input type="submit" value="　いいえ　">
</form>
</center>

({$inc_ktai_footer|smarty:nodefaults})
