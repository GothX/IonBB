<form action="" method="post" name="register" target="_self">
 <div class='category'>
  <div class='maintitle'>{L_ACC_DETAILS}</div>
  <table>
   <tr>
	<td class='info'>{L_NAME}:</td>
    <td><input type='text' name='regname' size='40' maxlength='40'></td>
   </tr>
   <tr>
    <td class='info'>{L_EMAIL}:</td>
    <td><input type='text' name='regemail' size='40' maxlength='100'></td>
   </tr>
   <tr>
    <td class='info'>{L_PASSWORD}:</td>
    <td><input type='password' name='password' size='40' maxlength='40'></td>
   </tr>
   <tr>
    <td class='info'>{L_CONFIRM_PASSWORD}:</td>
	<td><input name="confirm_password" type="password" size="40" maxlength="40"></td>
   </tr>
   <tr>
    <td class='catfoot' colspan='4'></td>
   </tr>
  </table>
 </div>
 <div class='category'>
  <div class='maintitle'>{L_PROFILE_DETAILS}</div>
  <table>
   <tr>
    <td class='info'>{L_TIMEZONE}:</td>
	<td>
	 <select id='timezone' name='timezone'><option value="-43200">{L_GMT_MINUS_1200}</option><option value="-39600">{L_GMT_MINUS_1100}</option><option value="-36000">{L_GMT_MINUS_1000}</option><option value="-32400">{L_GMT_MINUS_900}</option><option value="-28800">{L_GMT_MINUS_800}</option><option value="-25200">{L_GMT_MINUS_700}</option><option value="-21600">{L_GMT_MINUS_600}</option><option value="-18000">{L_GMT_MINUS_500}</option><option value="-14000">{L_GMT_MINUS_400}</option><option value="-12200">{L_GMT_MINUS_330}</option><option value="-10400">{L_GMT_MINUS_300}</option><option value="-7200">{L_GMT_MINUS_200}</option><option value="-3600">{L_GMT_MINUS_100}</option><option value="0" selected="selected" >{L_GMT_000}</option><option value="3600">{L_GMT_PLUS_100}</option><option value="7200">{L_GMT_PLUS_200}</option><option value="10400">{L_GMT_PLUS_300}</option><option value="12200">{L_GMT_PLUS_330}</option><option value="14000">{L_GMT_PLUS_400}</option><option value="16200">{L_GMT_PLUS_430}</option><option value="18000">{L_GMT_PLUS_500}</option><option value="19800">{L_GMT_PLUS_530}</option><option value="20700">{L_GMT_PLUS_545}</option><option value="21600">{L_GMT_PLUS_600}</option><option value="25200">{L_GMT_PLUS_700}</option><option value="28800">{L_GMT_PLUS_800}</option><option value="32400">{L_GMT_PLUS_900}</option><option value="34200">{L_GMT_PLUS_930}</option><option value="36000">{L_GMT_PLUS_1000}</option><option value="39600">{L_GMT_PLUS_1100}</option><option value="43200">{L_GMT_PLUS_1200}</option></select>
	</td>
   </tr>
   <tr>
    <td class='info'>{L_LOCATION}:</td>
	<td><input name="location" type="text" id="location" value="" size="40" maxlength="80" /></td>
   </tr>
   <tr>
    <td class='info'>{L_GENDER}:</td>
	<td><select id="gender" name="gender"><option value="1">{L_MALE}</option><option value="2">{L_FEMALE}</option><option value="3">{L_HIDDEN}</option></select></td>
   </tr>
  </table>
 </div>
 <div class='category'>
  <div class='maintitle'>{L_CAPTCHA}</div>
  <table>
   <tr>
    <td class='info'><img src='{URL}inc/captcha.php' border='0' alt=''></td>
	<td><input name="captcha" type="text" size="15" maxlength="25"></td>
   </tr>
  </table>
 </div>
	


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