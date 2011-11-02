<form action="" method="post" name="register" target="_self">
<div class="boxone"><font class="navfont">{L_ACC_DETAILS}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="regname" type="text" class="formcss" size="40" maxlength="40" />
      &nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="left"><font class="normfont">{L_EMAIL}:</font></div></td>
    <td><div align="left">
      <input name="regemail" type="text" class="formcss" size="40" maxlength="100" />
    </div></td>
  </tr>
  <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_PASSWORD}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="password" type="password" class="formcss" size="40" maxlength="40" />
      &nbsp;</div></td>
  </tr>
  <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_CONFIRM_PASSWORD}:</font></div></td>
    <td width="85%"><div align="left">
     <input name="confirm_password" type="password" class="formcss" size="40" maxlength="40" /></div></td>
  </tr>
</table>
</div>
<div class="boxone"><font class="navfont">{L_PROFILE_DETAILS}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
 <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_TIMEZONE}:</font></div></td>
    <td width="85%"><div align="left">
<select id="timezone" name="timezone" class="formcss"> 
<option value="-43200">{L_GMT_MINUS_1200}</option> 
<option value="-39600">{L_GMT_MINUS_1100}</option> 
<option value="-36000">{L_GMT_MINUS_1000}</option> 
<option value="-32400">{L_GMT_MINUS_900}</option> 
<option value="-28800">{L_GMT_MINUS_800}</option> 
<option value="-25200">{L_GMT_MINUS_700}</option> 
<option value="-21600">{L_GMT_MINUS_600}</option> 
<option value="-18000">{L_GMT_MINUS_500}</option> 
<option value="-14000">{L_GMT_MINUS_400}</option> 
<option value="-12200">{L_GMT_MINUS_330}</option> 
<option value="-10400">{L_GMT_MINUS_300}</option> 
<option value="-7200">{L_GMT_MINUS_200}</option> 
<option value="-3600">{L_GMT_MINUS_100}</option> 
<option value="0" selected="selected" >{L_GMT_000}</option> 
<option value="3600">{L_GMT_PLUS_100}</option> 
<option value="7200">{L_GMT_PLUS_200}</option> 
<option value="10400">{L_GMT_PLUS_300}</option> 
<option value="12200">{L_GMT_PLUS_330}</option> 
<option value="14000">{L_GMT_PLUS_400}</option> 
<option value="16200">{L_GMT_PLUS_430}</option>
<option value="18000">{L_GMT_PLUS_500}</option>
<option value="19800">{L_GMT_PLUS_530}</option>
<option value="20700">{L_GMT_PLUS_545}</option>
<option value="21600">{L_GMT_PLUS_600}</option> 
<option value="25200">{L_GMT_PLUS_700}</option>
<option value="28800">{L_GMT_PLUS_800}</option>
<option value="32400">{L_GMT_PLUS_900}</option>
<option value="34200">{L_GMT_PLUS_930}</option> 
<option value="36000">{L_GMT_PLUS_1000}</option> 
<option value="39600">{L_GMT_PLUS_1100}</option>
<option value="43200">{L_GMT_PLUS_1200}</option></select> 
</div></td>
  </tr>
<tr>
    <td width="15%"><div align="left"><font class="normfont">{L_LOCATION}:</font></div></td>
    <td width="85%"><div align="left">
      <input name="location" type="text" class="formcss" id="location" value="" size="40" maxlength="80" />
    </div></td>
</tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_GENDER}:</font></div></td>
    <td width="85%"><div align="left">
<select id="gender" name="gender" class="formcss"> 
<option value="1">{L_MALE}</option> 
<option value="2">{L_FEMALE}</option> 
<option value="3">{L_HIDDEN}</option> 
</select>
    </div></td>
  </tr>
</table>
</div>
<div class="boxtwo"></div>
<div align="center">
<div class="boxtwo" style="width: 300px; padding: 4px; margin: 4px;">
<font class="navfont">{L_CAPTCHA}</font><div class="boxthree">
<table>
<tr>
<td>
<img src="{URL}inc/captcha.php" border="0" alt="" /></td><td><input name="captcha" type="text" class="formcss" size="15" maxlength="25" /></td>
</tr>
</table>
</div>
</div></div>
<div class="boxone"><font class="navfont">{L_AGREEMENT}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
    <td colspan="2"><div align="center"> <textarea disabled="disabled" rows="5" name="tos" id="message" cols="20" style="width: 90%; height: 100" class="formcss" >{TOS}</textarea></div></td>
  </tr>
<tr>
    <td colspan="2"><div class="boxthree"><font class="normfont">{L_AGREEMENT_STATEMENT}</font></div></td>
    </tr> 
<tr>
    <td colspan="2"><div align="center"><input name="Submit" type="submit" class="formcss" value="{L_SUBMIT}"/></div></td>
    </tr>   
</table>
</div>
</form>