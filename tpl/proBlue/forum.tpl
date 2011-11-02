<!-- BEGIN menu -->
<form style="padding: 0px; margin: 0px" action="">
<input type="button" value ="{L_NEW}" class="globaltab" onclick="parent.location='./?s=viewforum&amp;f={FORUM_ID}&amp;mode=new'"/>
</form>
<!-- END menu -->
<!-- BEGIN normal -->
<!-- BEGIN subforum -->
<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="4">{L_SUBFORUM}</td></tr>
<tr class="boxtwo"><td width="1%">&nbsp; </td><td width = "45%"><div align="left" class="navfont">{L_FORUM}</div></td>
<td width="10%"><div align="center" class="navfont">{L_TOPICS}</div></td><td width="25%"><div align="center" class="navfont">{L_LATEST}</div></td></tr>
<!-- BEGIN subrow -->
<tr class="row{CLASS}"><td><img src="./tpl/{TPL}/img/{ICON}.gif" alt=""></td>
<td><div align="left"><font class="normfont">{FORUM}<br />{INFO}<br />{MODERATORS}</font></div></td>
<td><div align="center"><font class="normfont">{TOPIC_COUNT}</font></div></td>
<td><div align="center"><font class="normfont">{TOPIC}</font></div></td>
</tr>
<!-- END subrow -->
</table></div><div class="bodyline">
<!-- END subforum -->





<div class="pages">{PAGINATE}</div></div><div class="bodyline">

<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="5">{FORUM_NAME}</td></tr><tr class="boxtwo">
<td width="1%"><!-- BEGIN rss --><a href="{URL}rss.php?forum={FORUM_ID}"><img src="./img/feed.png" border="0" alt=""/></a><!-- END rss --></td>
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
<!-- END normal -->


<!-- BEGIN newtopic -->
<form action="" method="post" name="post" target="_self" enctype="multipart/form-data">
<div class="boxone"><font class="navfont">{L_NEW_TOPIC}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr>
<td width="11%"><div align="left"><font class="normfont">{L_TITLE}:</font></div></td>
<td width="89%"><div align="left">
<input name="title" type="text" class="formcss" size="40" maxlength="40" />
</div></td></tr>
<tr>
<td colspan="2"><div align="left">
<input type="button" value="B" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[b][/b]'" class="formcss" />
<input type="button" value="i" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[i][/i]'" class="formcss" />
<input type="button" value="U" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[u][/u]'"  class="formcss"/>
<input type="button" value="Size" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[size=8][/size]'" class="formcss" />
<input type="button" value="Color" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[color=000000][/color]'" class="formcss" />
<input type="button" value="Align" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[align=center]Text Here[/align]'" class="formcss" />
<input type="button" value="WWW" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[url=http://link here]Text Here[/url]'" class="formcss" />
<input type="button" value="Img" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[img]Text Here[/img]'" class="formcss" />

<input type="button" value="Youtube" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[youtube]Text Here[/youtube]'" class="formcss" />
<input type="button" value="Spoiler" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[spoiler= button text]content[/spoiler]'" class="formcss" />
</div></td></tr>
<tr><td colspan="2"><div align="left">
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[mad]'" /><img src="./img/smiley/mad.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[grin]'" /><img src="./img/smiley/biggrin.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[blink]'" /><img src="./img/smiley/blink.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[cool]'" /><img src="./img/smiley/cool.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[dry]'" /><img src="./img/smiley/dry.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[huh]'" /><img src="./img/smiley/huh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[laugh]'" /><img src="./img/smiley/laugh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[ohmy]'" /><img src="./img/smiley/ohmy.gif" alt="" border="0"></a></div></td></tr>
<tr><td colspan="2"><div align="center">
<textarea name="message" id="message" rows="10" cols="40" style="width: 98%; height: 50" class="formcss"></textarea>
</div></td></tr>
</table></div></div>

<div align="center" style="display: {ATTACHMENT}">
<div class="bodyline">
<div class="boxone"><font class="navfont">{L_ATTACHMENT}</font></div><div style="padding:6px"><input name="attachment" type="file" class="formcss"  size="50" maxlength="50"></div></div>
</div>

<div align="center" style="display: {POLL}">
<div class="bodyline"><div class="boxone"><font class="navfont">{L_POLL}</font></div><font class="normfont"><table><tr><td>{L_QUESTION}:</td><td><input name="question" type="text" class="formcss" size="40" maxlength="40" /></td></tr>
<tr><td>{L_OPTION} 1 :</td><td><input name="option1" type="text" class="formcss" size="40" maxlength="40" /></td></tr>
<tr><td>{L_OPTION} 2 :</td><td><input name="option2" type="text" class="formcss" size="40" maxlength="40" /></td></tr>
<tr><td>{L_OPTION} 3 :</td><td><input name="option3" type="text" class="formcss" size="40" maxlength="40" /></td></tr>
<tr><td>{L_OPTION} 4 :</td><td><input name="option4" type="text" class="formcss" size="40" maxlength="40" /></td></tr>
<tr><td>{L_OPTION} 5 :</td><td><input name="option5" type="text" class="formcss" size="40" maxlength="40" /></td></tr>
</table></font>
</div>
</div>
<div class="bodyline">
<div align="center"><input name="Submit" type="submit" value="{L_SUBMIT}" class="formcss" /></div>
</div>

</form>
<!-- END newtopic -->

   