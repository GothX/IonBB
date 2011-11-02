<form action="" method="post" name="config" target="_self"><div class="boxone"><font class="navfont">{L_AVATAR_SETTINGS}</font></div>
<div class="boxthree"><table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>
   <tr>
        <td width="120"><div align="left"><font class="normfont">{L_AVATARS}:</font></div></td>
        <td colspan="2"><div align="left"><font class="normfont">
          <select name="avatar" class="formcss">
            <option {AVYES} value="1">{L_ENABLED}</option>
            <option {AVNO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
        <td><div align="left"><font class="normfont">{L_AVATARS_MSG}</font></div></td>
      </tr>
  <tr>
    <td><div align="left"><font class="normfont">{L_FILESIZE}:</font></div></td>
    <td colspan="2"><div align="left"><input name="avatar_filesize" type="text" class="formcss" id="name" value="{FILESIZE}" size="4" maxlength="40" /></div></td>
	<td><div align="left"><font class="normfont">{L_FILESIZE_MSG}</font></div></td>
  </tr>
  <tr>
    <td ><div align="left"><font class="normfont">{L_HEIGHT}:</font></div></td>
    <td colspan="2"><div align="left"><input name="avatar_height" type="text" class="formcss" id="name" value="{HEIGHT}" size="4" maxlength="40" /></div></td>
	<td><div align="left"><font class="normfont">{L_HEIGHT_MSG}</font></div></td>
  </tr>
  <tr>
    <td ><div align="left"><font class="normfont">{L_WIDTH}:</font></div></td>
    <td colspan="2"><div align="left"><input name="avatar_width" type="text" class="formcss" id="name" value="{WIDTH}" size="4" maxlength="40" /></div></td>
	<td><div align="left"><font class="normfont">{L_WIDTH_MSG}</font></div></td>
  </tr> 
  <tr>
    <td colspan="4"><div align="center"><input name="submit" type="submit" class="formcss" value="{L_SUBMIT}"/></div></td>
  </tr>
</table>
</div>
</form>