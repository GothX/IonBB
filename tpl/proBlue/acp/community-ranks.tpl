
<!-- BEGIN ranks -->


<table width="100%" cellspacing="2" cellpadding="2">
<tr class="boxone"><td colspan="3"   style="padding: 4px">{L_RANKS}</td></tr>
<tr  class="boxtwo"><td width="10px"><font class="navfont"><center>{L_ID}</center></font></td><td width="75%"><font class="navfont"><center>{L_INFO}</center></font></td><td width="25%"><font class="navfont"><center>{L_OPTIONS}</center></font></td>

<!-- BEGIN row -->
<tr  class="row{CLASS}"><form action="" method="post" name="row" target="_self"><td><font class="normfont">{ID}</font></td><td><font class="normfont">{TITLE} {INFO}</font></td><td><input type="hidden" name="id" value="{ID}"><input name="edit" type="submit" class="formcss" value="{L_EDIT}"/><input name="delete" type="submit" class="formcss" value="{L_DELETE}"/></font></td></form>
</tr><!-- END row -->
</table>
</div><div class="bodyline">
<!-- BEGIN addrank -->
<div class="boxone"><font class="navfont">{L_ADD_RANK}</font></div><div class="boxtwo"></div>
<div class="boxthree"><table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>
    
    <form action="" method="post" name="rssinput" target="_self"><table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td><div align="left">
      <input name="name" type="text" class="formcss" size="40" maxlength="40" id="name" />
      &nbsp;</div></td>
  </tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_SPECIAL}:</font></div></td>
    <td width="85%"><div align="left">

<select id="special" name="special" class="formcss"> 
<option value="0">{L_NO}</option> 
<option value="1">{L_YES}</option> 






    </div></td>
  </tr>
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_POSTS}:</font></div></td>
    <td><div align="left">
      <input name="postcount" type="text" class="formcss" size="4" maxlength="4" id="postcount" />
      </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="newrank" value="{L_SUBMIT}" class="formcss"/>
    </div></td>
  </tr>
</table>
</form>
    
    
    </td>
  </tr>
</table></div>

<!-- END addrank -->

<!-- END ranks -->

<!-- BEGIN edit -->
<div class="boxone"><font class="navfont">{L_EDIT_RANK}</font></div><div class="boxtwo"></div>
<div class="boxthree"><table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>
    
    <form action="" method="post" name="rssinput" target="_self"><table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td><div align="left">
      <input name="name" type="text" class="formcss" size="40" maxlength="40" id="name" value="{NAME}"/>
      &nbsp;</div></td>
  </tr>
   <tr>
    <td width="15%"><div align="left"><font class="normfont">{L_SPECIAL}:</font></div></td>
    <td width="85%"><div align="left">

<select id="special" name="special" class="formcss"> 
<option value="0"{NORMAL}>No</option> 
<option value="1"{SPECIAL}>Yes</option> 






    </div></td>
  </tr>
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_POSTS}:</font></div></td>
    <td><div align="left">
      <input name="postcount" type="text" class="formcss" size="4" maxlength="4" id="postcount" value="{POSTCOUNT}"/>
      &nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="Submit" value="{L_SUBMIT}" class="formcss"/>
    </div></td>
  </tr>
</table>
</form>
    
    
    </td>
  </tr>
</table></div>
<!-- END edit -->
