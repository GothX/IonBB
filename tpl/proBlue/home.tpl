<!-- BEGIN menu -->
<form style="padding: 0px; margin: 0px" action="">
<input type="button" value ="{L_SEARCH}" class="globaltab" onclick="parent.location='./?s=search'"/>
<input type="button" value ="{L_NEW_POSTS}" class="globaltab" onclick="parent.location='./?s=search&amp;mode=new'"/>
</form>
<!-- END menu -->
<!-- BEGIN category -->
<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="4">{NAME}</td></tr>
<tr class="boxtwo"><td width="1%"></td><td width = "45%"><div align="left" class="navfont">{L_FORUM}</div></td>
<td width="10%"><div align="center" class="navfont">{L_TOPICS}</div></td><td width="25%"><div align="center" class="navfont">{L_LATEST}</div></td></tr>
<!-- END category -->
<!-- BEGIN row -->
<tr class="row{CLASS}"><td><img src="./tpl/{TPL}/img/{ICON}.gif" alt="" /></td>
<td><div align="left"><font class="normfont">{FORUM}<br />{INFO}<br />{SUB}{MODERATORS}</font></div></td>

<td><div align="center"><font class="normfont">{TOPIC_COUNT}</font></div></td>
<td><div align="center"><font class="normfont">{TOPIC}</font></div></td></tr>
<!-- END row -->
<!-- BEGIN category_end -->
</table>
<!-- END category_end -->

<!-- BEGIN break -->
</div><div class="bodyline">
<!-- END break -->


<div class="boxone">{L_SUMMARY}</div>
<div class="boxtwo"></div>
<div class="boxthree">{L_STATS}</div>
</div><div class="bodyline">
<div class="boxone">{L_ONLINE}</div>
<div class="boxtwo"></div>
<div class="boxthree">{ONLINE_STATS}</div>