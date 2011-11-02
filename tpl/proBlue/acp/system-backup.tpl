
<div class="boxone"><font class="navfont">{L_BACKUP}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">{L_BACKUP_MSG}<br /><center><form action="" method="post" name="row" target="_self"><input name="generate" type="submit" class="formcss" value="{L_GENERATE_BACKUP}"/></form></center></div>
</div><div class="bodyline">




<table width="100%" cellspacing="2" cellpadding="2">
<tr class="boxone"><td colspan="3"   style="padding: 4px">{L_BACKUP}</td></tr>
<tr  class="boxtwo"><td width="75%"><font class="normfont"><center>{L_BACKUP}</center></font></td><td width="25%"><font class="normfont"><center>{L_OPTIONS}</center></font></td>

<!-- BEGIN row -->
<tr  class="row{CLASS}"><form action="" method="post" name="row" target="_self"><td><font class="normfont"> {TITLE}</font></td><td><input type="hidden" name="id" value="{TITLE}"><input name="download" type="button" class="formcss" onClick="parent.location='./backups/{TITLE}'" value="{L_DOWNLOAD}"/> <input name="delete" type="submit" class="formcss" value="{L_DELETE}"/></font></td></form>
</tr><!-- END row -->
</table>
