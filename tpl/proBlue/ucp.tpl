<!-- BEGIN menu -->
<FORM style="padding: 0px; margin: 0px">
<INPUT TYPE="button" value ="{L_ACCOUNT}" class="globaltab" onClick="parent.location='./?s=ucp'">
<INPUT TYPE="button" value ="{L_SETTINGS}" class="globaltab" onClick="parent.location='./?s=ucp&amp;mode=settings'">
<INPUT TYPE="button" value ="{L_AVATAR}" class="globaltab" onClick="parent.location='./?s=ucp&amp;mode=avatar'">
<INPUT TYPE="button" value ="{L_SIGNATURE}" class="globaltab" onClick="parent.location='./?s=ucp&amp;mode=signature'">
</FORM>
<!-- END menu -->
<!-- BEGIN account -->
<div class="boxone"><font class="navfont">{L_ACCOUNT}</font></div>
   <div class="boxtwo"></div>
 <div class="boxthree">
 <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <form action="" method="post" name="register" target="_self"><tr>
    <td width="15%"><div align="left"><font class="normfont">{L_EMAIL}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="email" type="text" class="formcss" value="{EMAIL}" size="40" maxlength="100" readonly="true" />
    </div></td>
  </tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="name" type="text" class="formcss" id="name" value="{NAME}" size="40" maxlength="40" />
    </div></td>
  </tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_PASSWORD}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="pass" type="password" class="formcss" size="40" maxlength="40" id="pass" autocomplete="off"/>
    </div></td>
  </tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_NEW_PASSWORD}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="newpass" type="password" class="formcss" size="40" maxlength="40" id="newpass" autocomplete="off"/>
    </div></td>
  </tr>
  <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_NEW_PASSWORD_CONFIRM}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="confirmnewpass" type="password" class="formcss" size="40" maxlength="40" id="confirmnewpass" autocomplete="off"/>
    </div></td>
  </tr>

  <tr>
    <td colspan="2"><div align="center"><input name="Submit" type="submit" class="formcss" value="{L_SUBMIT}"/></div></td>
    </tr></form>
</table></div>
<!-- END account -->

<!-- BEGIN settings -->
<div class="boxone"><font class="navfont">{L_SETTINGS}</font></div>
   <div class="boxtwo"></div>
 <div class="boxthree">
 <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <form action="" method="post" name="register" target="_self">
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_NOTIFY}:</font></div></td>
    <td width="85%"><div align="left">
<select id="emailme" name="emailme" class="formcss">
<option value="0"{NOTIFY_NO}>{L_DISABLED}</option>
<option value="1"{NOTIFY_YES}>{L_ENABLED}</option>
</div></td>
  </tr><tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_TEMPLATE}:</font></div></td>
    <td width="85%"><div align="left">
     <select name="template" class="formcss">
        {TEMPLATE_BOX}
      </select>
    </div></td>
  </tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_TIMEZONE}:</font></div></td>
    <td width="85%"><div align="left">
<select id="timezone" name="timezone" class="formcss">
<option value="-43200"{a}>{L_GMT_MINUS_1200}</option> 
<option value="-39600"{b}>{L_GMT_MINUS_1100}</option>
<option value="-36000"{bb}>{L_GMT_MINUS_1000}</option> 
<option value="-32400"{c}>{L_GMT_MINUS_900}</option> 
<option value="-28800"{d}>{L_GMT_MINUS_800}</option> 
<option value="-25200"{e}>{L_GMT_MINUS_700}</option> 
<option value="-21600"{f}>{L_GMT_MINUS_600}</option> 
<option value="-18000"{g}>{L_GMT_MINUS_500}</option> 
<option value="-14000"{h}>{L_GMT_MINUS_400}</option> 
<option value="-12200"{i}>{L_GMT_MINUS_330}</option> 
<option value="-10400"{j}>{L_GMT_MINUS_300}</option> 
<option value="-7200"{k}>{L_GMT_MINUS_200}</option> 
<option value="-3600"{l}>{L_GMT_MINUS_100}</option> 
<option value="0"{m}>{L_GMT_000}</option> 
<option value="3600"{n}>{L_GMT_PLUS_100}</option> 
<option value="7200"{o}>{L_GMT_PLUS_200}</option>
<option value="10400"{p}>{L_GMT_PLUS_300}</option>
<option value="12200"{q}>{L_GMT_PLUS_330}</option>
<option value="14000"{r}>{L_GMT_PLUS_400}</option>
<option value="16200"{rr}>{L_GMT_PLUS_430}</option>
<option value="18000"{s}>{L_GMT_PLUS_500}</option>
<option value="19800"{ss}>{L_GMT_PLUS_530}</option>
<option value="20700"{sss}>{L_GMT_PLUS_545}</option>
<option value="21600"{t}>{L_GMT_PLUS_600}</option>
<option value="25200"{u}>{L_GMT_PLUS_700}</option>
<option value="28800"{v}>{L_GMT_PLUS_800}</option>
<option value="32400"{w}>{L_GMT_PLUS_900}</option>
<option value="34200"{ww}>{L_GMT_PLUS_930}</option>
<option value="36000"{www}>{L_GMT_PLUS_1000}</option>
<option value="39600"{x}>{L_GMT_PLUS_1100}</option>
<option value="43200"{y}>{L_GMT_PLUS_1200}</option></select>
    </div></td>
  </tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_LOCATION}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="location" type="text" class="formcss" id="location" value="{LOCATION}" size="40" maxlength="80" />
    </div></td>
</tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_GENDER}:</font></div></td>
    <td width="85%"><div align="left">
<select id="gender" name="gender" class="formcss">
<option value="1"{MALE}>{L_MALE}</option>
<option value="2"{FEMALE}>{L_FEMALE}</option>
<option value="3"{HIDDEN}>{L_HIDDEN}</option>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><input name="Submit" type="submit" class="formcss" value="{L_SUBMIT}"/></div></td>
    </tr></form>
</table></div>
<!-- END settings -->

<!-- BEGIN avatar -->


<div class="boxone"><font class="navfont">{L_AVATAR}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">

<div align="center"><form name="newad" method="post" enctype="multipart/form-data"  action="">
 <table width="100%">
 	<tr>
 	  <td valign="middle" rowspan="2" width="5"><div align="center">{AVATAR}</div></td>
 	  <td><div align="center">
 	  <input name="image" type="file" class="formcss"  size="50" maxlength="50" class="formcss">
 	  </div><div align="center">
 	  <input name="Avi" type="submit" class="formcss" value="{L_SUBMIT}"> <input name="Delete" type="submit" class="formcss" value="{L_DELETE}">
 	  </div></td></tr>

 </table>
 </form></div>

</div>
<!-- END avatar -->

<!-- BEGIN signature -->
<div class="boxone"><font class="navfont">{L_PREVIEW}</font></div>
<div class="boxtwo"></div>
<div class="boxthree"><center><font class="normfont">{PREVIEW}</font></center></div>

<div class="boxone"><font class="navfont">{L_SIGNATURE}</font></div>
<div class="boxtwo"></div>
<div class="boxthree"><font class="navfont"> <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <form action="" method="post" name="post" target="_self">
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
    <td><div align="center"> <textarea rows="2" name="signature" id="message" cols="20" style="width: 98%; height: 100" class="formcss" >{SIGNATURE}</textarea></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><input name="Submit" type="submit" class="formcss" value="{L_SUBMIT}"/></div></td>
    </tr></form>
</table></font></div>


<!-- END signature -->





