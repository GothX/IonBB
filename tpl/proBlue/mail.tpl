<!-- BEGIN menu -->
<FORM style="padding: 0px; margin: 0px">
<INPUT TYPE="button" value ="{L_NEW}" class="globaltab" onClick="parent.location='./?s=mail&amp;mode=new'">
<INPUT TYPE="button" value ="{L_INBOX}" class="globaltab" onClick="parent.location='./?s=mail'">
<INPUT TYPE="button" value ="{L_SENTBOX}" class="globaltab" onClick="parent.location='./?s=mail&amp;mode=sent'">
</FORM>
<!-- END menu -->



<!-- BEGIN new -->
<div class="boxone">{L_NEW_MAIL}</div>
<div class="boxtwo"></div>
<div class="boxthree">
    

     <table width="100%" border="0" cellspacing="2" cellpadding="4">
<form action="" method="post" name="post" target="_self">
  <tr>

    <td width="11%"><div align="left"><font class="normfont">{L_USER}:</font></div></td>

    <td width="89%"><div align="left">

      <input name="user" type="text" class="formcss" size="40" maxlength="40" value="{USERNAME}" />

    </div></td>



  
  <tr>
  <tr>

    <td width="11%"><div align="left"><font class="normfont">{L_TITLE}:</font></div></td>

    <td width="89%"><div align="left">

      <input name="title" type="text" class="formcss" size="40" maxlength="40" />

    </div></td>



  
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
    </div></td>

    </tr>

  <tr>

    <td colspan="2"><div align="left">

<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[mad]'" /><img src="./img/smiley/mad.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[grin]'" /><img src="./img/smiley/biggrin.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[blink]'" /><img src="./img/smiley/blink.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[cool]'" /><img src="./img/smiley/cool.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[dry]'" /><img src="./img/smiley/dry.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[huh]'" /><img src="./img/smiley/huh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[laugh]'" /><img src="./img/smiley/laugh.gif" alt="" border="0"></a>
<a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[ohmy]'" /><img src="./img/smiley/ohmy.gif" alt="" border="0"></a></div></td></tr>

  </div></td>

  </tr>

  <tr>

    <td colspan="2"><div align="center">

      <textarea name="message" id="message" rows="10" cols="40" style="width: 98%; height: 50" class="formcss"></textarea>

    </div></td>

  </tr>

  <tr>

    <td colspan="2"><div align="center"><input name="Submit" type="submit" value="{L_SUBMIT}" class="formcss" /></div></td>

  </tr>
</form>
    </table>
</div>


    

    
<!-- END new -->
<!-- BEGIN view -->



<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="5">{TITLE}</td></tr>
<!-- BEGIN row -->
<tr class="boxtwo">

<td width="20%"><div align="left" class="navfont"><b> {ID}</b></div></td>
<td width="80%"><div align="left" class="navfont"><b>{DATE}</b></div></td>

</tr>

<tr class="row0">

<td valign="top"><div align="center" class="normfont">{AUTHOR}<br />{RANK}<br />{AVATAR}<br />
<strong>{L_STATUS}:</strong> {STATUS}
</div></td>
<td valign="top">


<font class="normfont">

{TEXT}
</font>
</td>

</tr>

</table>

<!-- BEGIN reply -->
</div><div class="bodyline">
<div class="boxone"><font class="navfont">{L_REPLY}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
    


     <table width="100%" border="0" cellspacing="2" cellpadding="4">
<form action="" method="post" name="post">
<tr>

    <td colspan="2"><div align="left">

      <input type="button" value="B" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[b][/b]'" class="formcss" />

      <input type="button" value="i" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[i][/i]'" class="formcss" />

      <input type="button" value="U" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[u][/u]'"  class="formcss"/>

      <input type="button" value="Size" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[size=8][/size]'" class="formcss" />

      <input type="button" value="Color" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[color=000000][/color]'" class="formcss" />

      <input type="button" value="WWW" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[url=http://link here]Text Here[/url]'" class="formcss" />

      <input type="button" value="Img" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[img]Text Here[/img]'" class="formcss" />

	  <input type="button" value="Youtube" onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[youtube]Text Here[/youtube]'" class="formcss" />

    </div></td>

  </tr>

  <tr>

    <td colspan="2"><div align="left">

      <a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[mad]'" /><img src="./images/smiley/mad.gif" alt="" border="0"></a>

      <a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[grin]'" /><img src="./images/smiley/biggrin.gif" alt="" border="0"></a>

      <a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[blink]'" /><img src="./images/smiley/blink.gif" alt="" border="0"></a>

      <a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[cool]'" /><img src="./images/smiley/cool.gif" alt="" border="0"></a>

      <a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[dry]'" /><img src="./images/smiley/dry.gif" alt="" border="0"></a>

      <a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[huh]'" /><img src="./images/smiley/huh.gif" alt="" border="0"></a>

      <a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[laugh]'" /><img src="./images/smiley/laugh.gif" alt="" border="0"></a>

      <a nohref onclick="document.forms['post']. elements['message'].value=document.forms['post']. elements['message'].value+'[ohmy]'" /><img src="./images/smiley/ohmy.gif" alt="" border="0"></a>

  </div></td>

  </tr>

  <tr>

    <td width="100%"><div align="center">

      <textarea name="message" id="message" rows="4" cols="40" style="width: 98%; height: 50" class="formcss"></textarea>

    </div></td>

  </tr>

  <tr>

    <td><div align="center"><input name="Submit" type="submit" value="{L_SUBMIT}" class="formcss" /></div></td>

  </tr>
</form>
    </table></div>
<!-- END reply -->

<!-- END view -->

<!-- BEGIN normal -->


<div class="pages">{PAGES}</div>

</div><div class="bodyline">

<form name="form1" method="post" action=""><table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="5"> {L_TITLE}</td></tr>
  <tr class="boxtwo">
    <td width="1%">&nbsp; </td>
    <td ><div align="left" class="navfont">
    <b>{L_MESSAGE}</b>
    </div>
</td>
    <td width="1%"><div align="center" class="navfont">{L_TO_FROM}</div></td>
</td>
    <td width="1%"><div align="center" class="navfont">{L_DATE}</div></td>
<td width="1%"><div align="center" class="navfont">{L_DELETE}</div></td>
  </tr>
<!-- BEGIN row -->
  <tr class="row{CLASS}">
    <td width="5%"><img src="./tpl/{TPL}/img/{ICON}.gif" alt=""></td>
    <td width="55%"><div align="left">
      <font class="normfont">{TITLE}</font>
    </div>
  </td>
<td width="20%"><div align="center">
      <font class="normfont">{AUTHOR}</font>
    </div></td>
<td width="20%"><div align="center">
      <font class="normfont">{DATE}</font>
    </div></td>
<td width="20%"><div align="center">
     <input name="checkbox[]" type="checkbox" id="checkbox[]" value="{ID}">
    </div></td>
  </tr>
<!-- END row -->
<!-- BEGIN delete -->
<tr>
<td colspan="5" align = "right" class="boxtwo"><input name="delete" type="submit" id="delete" value="{L_DELETE}" class="formcss"></td>
</tr>
<!-- END delete --></table></form>
</div><div class="bodyline">
<div class="pages">{PAGES}</div>

<!-- END normal -->
