<!-- BEGIN view -->
<div class="boxone">{L_GROUP}</div>

<table width="100%">
<tr><td width = "20%"><font class="normfont">{L_NAME}:</font></td><td><font class="normfont">{GROUP_NAME}</font>
<tr><td width = "20%"><font class="normfont">{L_INFO}:</font></td><td><font class="normfont">{GROUP_DESCRIPTION}</font>
</td><tr>
</table>
<!-- BEGIN members -->
</div><div class="bodyline">
<div class="pages">{PAGINATE}</div></div><div class="bodyline">

<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="5">{L_MEMBERS}</td></tr><tr class="boxtwo">
<td width="10%"><div align="center" class="navfont"><b>{L_ID}</b></div></td>
<td width="45%"><div align="center" class="navfont"><b>{L_NAME}</b></div></td>
<td width="45%"><div align="center" class="navfont"><b>{L_JOINED}</b></div></td>
</tr>
<!-- BEGIN row -->
<tr class="row{CLASS}">
<td><div align="center" class="normfont">{ID}</div></td>
<td><div align="center" class="normfont">{NAME}</div></td>
<td><div align="center" class="normfont">{JOINED}</div></td>
</tr>
<!-- END row -->
</table>
</div><div class="bodyline">
<div class="pages">{PAGINATE}</div>
<!-- END members -->

<!-- END view -->
<!-- BEGIN normal -->
<div class="pages">{PAGINATE}</div></div><div class="bodyline">

<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="5">{L_GROUPS}</td></tr><tr class="boxtwo">
<td width="10%"><div align="center" class="navfont"><b>{L_ID}</b></div></td>
<td width="30%"><div align="center" class="navfont"><b>{L_GROUP}</b></div></td>
<td width="60%"><div align="center" class="navfont"><b>{L_INFO}</b></div></td>
</tr>
<!-- BEGIN row -->
<tr class="row{CLASS}">
<td><div align="center" class="normfont">{ID}</div></td>
<td><div align="center" class="normfont">{GROUP}</div></td>
<td><div align="left" class="normfont">{INFO}</div></td>
</tr>
<!-- END row -->
</table>
</div><div class="bodyline">
<div class="pages">{PAGINATE}</div>

<!-- END normal -->