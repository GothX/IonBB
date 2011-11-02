<!-- BEGIN menu -->
<FORM action="" method="post" target="_self" style="padding: 0px; margin: 0px">
<INPUT TYPE="button" value ="{L_REPLY}" class="globaltab" onClick="parent.location='./?s=viewtopic&amp;t={TOPIC_ID}&amp;mode=reply'">
<INPUT TYPE="submit" value ="{L_WATCHING}" class="globaltab" name="{WATCHING}">
</FORM>
<!-- END menu -->
<!-- BEGIN normal -->
<form action="" method="post" target="_self" style="padding: 0px; margin: 0px">
<!-- BEGIN poll -->
<div class="boxone"> {L_POLL}: {QUESTION}</div>
<center><font class="normfont"><table>{OPTIONS}</table></font></center>
</div><div class="bodyline">
<!-- END poll -->
<!-- BEGIN moderator -->
<div class="boxone"><table border="0" cellspacing="0" cellpadding="2">
<tr><td><INPUT TYPE="submit" name = "{LOCKED}" value ="{L_LOCKED}" class="globaltab" style="width: 50px"></td>
<td style="display: {POLL}"><INPUT TYPE="submit" value ="{L_DELETE_POLL}" class="globaltab" name="delete_poll"  style="width: 90px"></td>
<td><INPUT TYPE="submit" value ="{L_DELETE_TOPIC}" class="globaltab" name="delete_topic"  style="width: 90px"></td>
<td><input name="delete_posts" type="submit" value="{L_DELETE_SELECTED}" class="globaltab"style="width: 100px"></td>
<td></td>
<td><div align="left"><select size="1" name="sticky" class="globaltab"  style="width: 100px">
<option value="0" {NORMAL}>{L_NORMAL}</option> 
<option value="1" {STICKY}>{L_STICKY}</option> 
<option value="2" {ANNOUNCEMENT}>{L_ANNOUNCEMENT}</option>           
</select></div></td><td><div align="left"><input type="submit" name="sticky_submit" value="{L_SET}" class="globaltab"  style="width: 50px"/></div></td>
<td><div align="left"><select size="1" name="move" class="globaltab" style="width: 100px">{MOVE}
</select></div></td><td><div align="left"><input type="submit" name="move_submit" value="{L_MOVE}" class="globaltab"  style="width: 50px"/></div></td></tr></table></div></div><div class="bodyline">
<!-- END moderator -->
<div class="pages">{PAGINATE}</div></div>
<div class="bodyline">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
<tr class="boxone"><td colspan="5">{TOPIC_NAME}</td></tr>
<!-- BEGIN row -->
<tr class="boxtwo">
<td width="20%"><div align="left" class="navfont">{BOX}<b> {ID}</b></div></td>
<td width="80%"><div align="left" class="navfont"><b>{DATE}</b></div></td>
</tr>
<tr class="cell0">
<td valign="top"><div align="center" class="normfont">{AUTHOR}<br />{RANK}<br />{AVATAR}<br />
<strong>{L_POSTS}:</strong> {POSTCOUNT}<br />
<strong>{L_STATUS}:</strong> {STATUS}<br />
<strong>{L_REPUTATION}:</strong> {REPUTATION}</div></td>
<td valign="top">
<font class="normfont">
{TEXT}
<br><br>
{SIGNATURE}
</font>
</td>
</tr>
<tr class="cell1"><td colspan="2">
<div style="height: 25px; text-align:right;">
<!-- BEGIN rep -->
<a href="{URL}?s=viewtopic&amp;t={T}&amp;mode=reputation-add&amp;post_id={ID}" class="formcss">+ {L_REP}</a> 
<a href="{URL}?s=viewtopic&amp;t={T}&amp;mode=reputation-remove&amp;post_id={ID}" class="formcss">- {L_REP}</a> 
<!-- END rep -->
<!-- BEGIN logged_in -->
<a href="{URL}?s=profile&user={AUTHOR_ID}" class="formcss">{L_PROFILE}</a> 
<a href="{URL}?s=mail&amp;mode=new&amp;user={AUTHOR_ID}" class="formcss">{L_MAIL}</a> 
<a href="{URL}?s=viewtopic&amp;t={T}&amp;mode=quote&amp;post_id={ID}" class="formcss">{L_QUOTE}</a> 
<a href="{URL}?s=viewtopic&amp;t={T}&amp;mode=report&amp;post_id={ID}" class="formcss">{L_REPORT}</a> 
<!-- END logged_in -->
<!-- BEGIN authorbutton -->
<a href="{URL}?s=viewtopic&amp;t={T}&amp;mode=edit&amp;post_id={ID}" class="formcss">{L_EDIT}</a> 
<!-- END authorbutton -->
<!-- BEGIN attachbutton -->
<a href="{URL}./?s=viewtopic&amp;t={T}&amp;mode=delete_attachment&amp;post_id={ID}" class="formcss">{L_DELETE_ATTACHMENT}</a> 
<!-- END attachbutton -->
</div>
</td></tr>
<!-- END row -->
</table>
</div>
<!-- BEGIN facebook_like -->
</div>
<div class="bodyline">
<div style=" padding:2px;"><iframe src="http://www.facebook.com/plugins/like.php?href={URL}?topic={T}&show_faces=false"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:24px; padding:2px;"></iframe>
</div>
<!-- END facebook_like -->
</div><div class="bodyline">
<div class="pages">{PAGINATE}</div>
</div>





<div class="bodyline">
 
<div class="boxone">{L_VIEWING}</div>
<div class="boxtwo"></div>
<div class="boxthree">{USERS}</div>


</div></form>
<!-- END normal -->
<!-- BEGIN reply -->


<div class="boxone"><font class="navfont">{L_REPLY}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="2" cellpadding="4">
<form action="" method="post" name="postreply" enctype="multipart/form-data">
<tr><td colspan="2"><div align="left">
<input type="button" value="B" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[b][/b]'" class="formcss" />
<input type="button" value="i" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[i][/i]'" class="formcss" />
<input type="button" value="U" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[u][/u]'"  class="formcss"/>
<input type="button" value="Size" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[size=8][/size]'" class="formcss" />
<input type="button" value="Color" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[color=000000][/color]'" class="formcss" />
<input type="button" value="Align" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[align=center]Text Here[/align]'" class="formcss" />
<input type="button" value="WWW" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[url=http://link here]Text Here[/url]'" class="formcss" />
<input type="button" value="Img" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[img]Text Here[/img]'" class="formcss" />
<input type="button" value="Youtube" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[youtube]Text Here[/youtube]'" class="formcss" />
<input type="button" value="Spoiler" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[Spoiler=button text]content[/spoiler]'" class="formcss" />
</div></td></tr>
<tr><td colspan="2"><div align="left">
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[mad]'" /><img src="./img/smiley/mad.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[grin]'" /><img src="./img/smiley/biggrin.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[blink]'" /><img src="./img/smiley/blink.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[cool]'" /><img src="./img/smiley/cool.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[dry]'" /><img src="./img/smiley/dry.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[huh]'" /><img src="./img/smiley/huh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[laugh]'" /><img src="./img/smiley/laugh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[ohmy]'" /><img src="./img/smiley/ohmy.gif" alt="" border="0"></a>
</div></td></tr>
<tr><td width="100%"><div align="center">
<textarea name="message" rows="4" cols="40" style="width: 98%; height: 50" class="formcss"></textarea>
</div></td>
</tr><tr><td colspan="2"><div align="center" style="display: {ATTACHMENT}"><input name="attachment" type="file" class="formcss"  size="50" maxlength="50"></div></td></tr><tr><td><div align="center"><input name="Submit" type="submit" value="{L_SUBMIT}" class="formcss" /></div></td></tr></form> </table></div>

</div><div class="bodyline">
<div class="boxone"><font class="navfont">{L_TOPIC}</font></div>
<div class="boxtwo"></div>
<div style="height: 100px;
width: 100%;
overflow: auto;
border: 0px;">
<!-- BEGIN reply_row -->
<div class="cell{CLASS}"><font class="normfont">{AUTHOR} - {DATE}<br />{TEXT}</font></div>
<!-- END reply_row -->

</div>

<!-- END reply -->
<!-- BEGIN edit -->
<div class="boxone"><font class="navfont">{L_EDIT}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="0" cellpadding="2"><tr><td>
<form action="" method="post" name="postreply"><table width="100%" border="0" cellspacing="0" cellpadding="4">

<!-- BEGIN title --><tr>
<td width="100%" colspan="2"><div align="left">
<input name="title" type="text" class="formcss" size="40" maxlength="40" value="{TITLE}"/>
</div></td>
</tr>
<!-- END title -->
<tr><td colspan="2"><div align="left">
<input type="button" value="B" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[b][/b]'" class="formcss" />
<input type="button" value="i" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[i][/i]'" class="formcss" />
<input type="button" value="U" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[u][/u]'"  class="formcss"/>
<input type="button" value="Size" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[size=8][/size]'" class="formcss" />
<input type="button" value="Color" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[color=000000][/color]'" class="formcss" />
<input type="button" value="Align" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[align=center]Text Here[/align]'" class="formcss" />
<input type="button" value="WWW" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[url=http://link here]Text Here[/url]'" class="formcss" />
<input type="button" value="Img" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[img]Text Here[/img]'" class="formcss" />
<input type="button" value="Youtube" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[youtube]Text Here[/youtube]'" class="formcss" />
<input type="button" value="Spoiler" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[spoiler = button text]content[/youtube]'" class="formcss" /></div></td></tr>
<tr><td colspan="2" colspan="2"><div align="left">
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[mad]'" /><img src="./images/smiley/mad.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[grin]'" /><img src="./images/smiley/biggrin.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[blink]'" /><img src="./images/smiley/blink.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[cool]'" /><img src="./images/smiley/cool.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[dry]'" /><img src="./images/smiley/dry.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[huh]'" /><img src="./images/smiley/huh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[laugh]'" /><img src="./images/smiley/laugh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[ohmy]'" /><img src="./images/smiley/ohmy.gif" alt="" border="0"></a>
</div></td></tr>
<tr><td width="100%" colspan="2"><div align=center"><textarea name="message" id="message" rows="4" cols="40" style="width: 98%; height: 50" class="formcss">{MESSAGE}</textarea></div></td></tr>
<tr><td colspan="2"><div align="center"><table style="padding: 4px;"><tr><td><input name="Submit" type="submit" value="{L_SUBMIT}" class="formcss"/></td></tr></table></div></td>
</tr></table></form></td></tr>
</table></div>
<!-- END edit -->
<!-- BEGIN quote -->
<div class="boxone"><font class="navfont">{L_QUOTE}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="0" cellpadding="2"><tr><td>
<form action="" method="post" name="postreply" enctype="multipart/form-data"><table width="100%" border="0" cellspacing="0" cellpadding="4">
<tr><td colspan="2"><div align="left">
<input type="button" value="B" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[b][/b]'" class="formcss" />
<input type="button" value="i" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[i][/i]'" class="formcss" />
<input type="button" value="U" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[u][/u]'"  class="formcss"/>
<input type="button" value="Size" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[size=8][/size]'" class="formcss" />
<input type="button" value="Color" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[color=000000][/color]'" class="formcss" />
<input type="button" value="WWW" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[url=http://link here]Text Here[/url]'" class="formcss" />
<input type="button" value="Img" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[img]Text Here[/img]'" class="formcss" />
<input type="button" value="Youtube" onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[youtube]Text Here[/youtube]'" class="formcss" />
</div></td></tr>
<tr><td colspan="2"><div align="left">
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[mad]'" /><img src="./images/smiley/mad.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[grin]'" /><img src="./images/smiley/biggrin.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[blink]'" /><img src="./images/smiley/blink.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[cool]'" /><img src="./images/smiley/cool.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[dry]'" /><img src="./images/smiley/dry.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[huh]'" /><img src="./images/smiley/huh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[laugh]'" /><img src="./images/smiley/laugh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['postreply']. elements['message'].value=document.forms['postreply']. elements['message'].value+'[ohmy]'" /><img src="./images/smiley/ohmy.gif" alt="" border="0"></a>
</div></td></tr>
<tr><td width="100%"><div align=center">
<textarea name="message" id="message" rows="4" cols="40" style="width: 98%; height: 50" class="formcss">{MESSAGE}</textarea>
</div></td></tr><tr><td colspan="2"><div align="center"  style="display: {ATTACHMENT}"><input name="attachment" type="file" class="formcss" size="50" maxlength="50"></div></td></tr><tr>
<td><div align="center"><input name="Submit" type="submit" value="{L_SUBMIT}" class="formcss"/></div></td>
</tr></table>
</form></td></tr></table></div>
<!-- END quote -->
<!-- BEGIN report -->
<div class="boxone"><font class="navfont">{L_REPORT}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="2" cellpadding="4"><form action="" method="post" name="post" target="_self"><tr>
<td colspan="2"><div align="center">
<textarea name="reason" id="reason" rows="10" cols="40" style="width: 98%; height: 50" class="formcss"></textarea>
</div></td></tr><tr>
<td colspan="2"><div align="center"><input name="Submit" type="submit" value="{L_SUBMIT}" class="formcss" /></div></td></tr>
</form></table></div>
<!-- END report -->
