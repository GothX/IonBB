
<!-- BEGIN new -->

<div class="pages">{PAGINATE}</div></div><div class="bodyline">

<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="5">{L_RESULTS}</td></tr><tr class="boxtwo">
<td width="1%"></td>
<td width="49%"><div align="center" class="navfont"><b>{L_TOPIC}</b></div></td>
<td width="20%"><div align="center" class="navfont"><b>{L_AUTHOR}</b></div></td>
<td width="5%"><div align="center" class="navfont"><b>{L_REPLIES}</b></div></td>
<td width="40%"><div align="center" class="navfont"><b>{L_LATEST}</b></div></td></tr>
<!-- BEGIN row -->
<tr class="row{CLASS}">
<td><img src="./tpl/{TPL}/img/{ICON}.gif" alt=""/></td>
<td><div align="left" class="normfont">{TOPIC} {PAGES} </div></td>
<td><div align="center" class="normfont">{AUTHOR}</div></td>
<td><div align="center" class="normfont">{REPLIES}</div></td>
<td><div align="center" class="normfont">{USER}<br /> {DATE}</div></td>
</tr>
<!-- END row -->
</table>
</div><div class="bodyline">
<div class="pages">{PAGINATE}</div>
</div><div class="bodyline">
<div class="boxone">{L_VIEWING}</div>
<div class="boxtwo"></div>
<div class="boxthree">{USERS}</div>
<!-- END new -->


<!-- BEGIN search_results -->

<div class="pages">{PAGINATE}</div>


<!-- BEGIN search_row -->
</div><div class="bodyline">
<div class="boxone">{TOPIC}</div><div class="boxthree">
{TEXT}</div>
<div align="right"><INPUT TYPE="button" value ="{L_VIEW}" class="formcss" onClick="parent.location='./?s=viewtopic&amp;t={TOPIC_ID}'"></div>



<!-- END search_row -->
</div><div class="bodyline">
<div class="pages">{PAGINATE}</div>
</div><div class="bodyline">
<div class="boxone">{L_VIEWING}</div>
<div class="boxtwo"></div>
<div class="boxthree">{USERS}</div>
<!-- END search_results -->

<!-- BEGIN search -->

<div class="boxone"><font class="navfont">{L_SEARCH}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="2" cellpadding="4">
<form action="" method="post" name="post" target="_self"><tr>
<td width="11%"><div align="left"><font class="normfont">{L_SEARCH}:</font></div></td>
<td width="89%"><div align="left">
<input name="term" type="text" class="formcss" size="40" maxlength="100" value="" />
</div></td></tr>
<tr><td colspan="2"><div align="center"><input name="Submit" type="submit" value="{L_SUBMIT}" class="formcss" /></div></td></tr>
</form>
</table></div>







<!-- END search -->

