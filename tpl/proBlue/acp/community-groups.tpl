<!-- BEGIN group -->
<div class="boxone">{L_GROUP_SETTINGS}</div>
<form action="" method="post" target="_self">
<table width="100%">
<tr><td width = "20%"><font class="normfont">{L_TITLE}:</font></td><td><input name="name" type="text" class="formcss" size="40" maxlength="40" value="{GROUP_NAME}"/></td><tr>
<tr><td width = "20%"><font class="normfont">{L_COLOUR}:</font></td><td><input name="colour" type="text" class="formcss" size="40" maxlength="40" value ="{GROUP_COLOUR}"/></td><tr>
<tr><td width = "20%"><font class="normfont">{L_DESCRIPTION}:</font></td><td>  <textarea name="description" rows="10" cols="40" style="width: 90%; height: 50px" class="formcss">{GROUP_DESCRIPTION}</textarea>
</td><tr>
<tr><td colspan = "2"><center><input type="submit" name="Submit" value="{L_SUBMIT}" class="formcss"/> <input type="submit" name="delete-group" value="{L_DELETE_GROUP}" class="formcss"/></center></td><tr>
</table>
</form>

</div><div class="bodyline">
<div class="boxone">{L_ADD_MEMBER}</div>
<form action="" method="post" target="_self">
<table width="100%">
<tr>
    <td width="11%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td><div align="left">
      <input name="name" type="text" class="formcss" size="40" maxlength="40" id="name" />
      &nbsp;</div></td>
<td><input type="submit" name="add" value="{L_ADD}" class="formcss"/></td>
  </tr>
</table>
</form>
</div><div class="bodyline">
<div class="boxone">{L_MEMBERS}</div>
<form action="" method="post" target="_self">

<select class="formcss" style="width: 98%; margin:1;"name="members" multiple="multiple" size="5">
{MEMBERS}
</select>
<center><input type="submit" name="remove" value="{L_REMOVE}" class="formcss"/></center>
</form>

<!-- END group -->

<!-- BEGIN normal -->


<div class="boxone">{L_SELECT_GROUP}</div>
<form action="" method="post" target="_self">
<center>
<table width="400">
<tr>
    <td><div align="left">
      <select size="1" name="group" class="formcss" style="width:100%">
 {GROUPS}           
 </select></div></td>
<td><input type="submit" name="Submit" value="{L_SUBMIT}" class="formcss"/></td>
  </tr>
</table>
</center>
</form>
</div><div class="bodyline">
<div class="boxone">{L_NEW_GROUP}</div>
<form action="" method="post" target="_self">
<table width="100%">
<tr><td width = "20%"><font class="normfont">{L_TITLE}:</font></td><td><input name="name" type="text" class="formcss" size="40" maxlength="40"/></td><tr>
<tr><td width = "20%"><font class="normfont">{L_COLOUR}:</font></td><td><input name="colour" type="text" class="formcss" size="40" maxlength="40"/></td><tr>
<tr><td width = "20%"><font class="normfont">{L_DESCRIPTION}:</font></td><td>  <textarea name="description" rows="10" cols="40" style="width: 90%; height: 50px" class="formcss"></textarea>
</td><tr>
<tr><td colspan = "2"><center><input type="submit" name="add-group" value="{L_SUBMIT}" class="formcss"/> </center></td><tr>
</table>
</form>
<!-- END normal -->