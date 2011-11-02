<div class="boxone"><table border="0" cellspacing="0" cellpadding="2">
<tr><td><INPUT TYPE="button" onClick="parent.location='{URL}acp/?s=forums&amp;mode=new-forum'" name = "add_forum" value ="{L_ADD_FORUM}" class="globaltab" style="width:120px"></td>
<td ><INPUT TYPE="button" onClick="parent.location='{URL}acp/?s=forums&amp;mode=new-category'" name = "add_category" value ="{L_ADD_CATEGORY}" class="globaltab" style="width:120px"></td>
</tr></table></div></div><div class="bodyline">

<!-- BEGIN new-category -->
<div class="boxone"><font class="navfont">{L_ADD_CATEGORY}</font></div>
<div class="boxtwo"></div>
<div class="boxthree"><table width="100%" border="0" cellspacing="0" cellpadding="0">

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
    <td colspan="2"><div align="center">
      <input type="submit" name="Submit" value="{L_SUBMIT}" class="formcss"/>
    </div></td>
  </tr>
</table>
</form>
    
    
    </td>
  </tr>
</table></div>
<!-- END new-category -->
<!-- BEGIN new-forum -->
<div class="boxone"><font class="navfont">{L_ADD_FORUM}</font></div>
<div class="boxtwo"></div>
<div class="boxthree"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td>
    
    <form action="" method="post" target="_self"><table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td><div align="left">
      <input name="name" type="text" class="formcss" size="40" maxlength="40" id="name" />
      &nbsp;</div></td>
  </tr>
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_INFO}:</font></div></td>
    <td><div align="left">
      <input name="info" type="text" class="formcss" size="40" maxlength="60" id="info" />
      &nbsp;</div></td>
  </tr>
<tr>
    <td><div align="left"><font class="normfont">{L_CATEGORY}:</font></div></td>
    <td><div align="left">
      <select size="1" name="category" class="formcss">
        
                                                               {CATEGORIES}           
    
      </select>
    </div></td>
  </tr>
<tr>
    <td><div align="left"><font class="normfont">{L_PARENT}:</font></div></td>
    <td><div align="left">
      <select size="1" name="parent" class="formcss">
        
                                                               {FORUMS}           
    
      </select>
    </div></td>
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
<!-- END new-forum -->

<!-- BEGIN edit-category -->

<div class="boxone"><font class="navfont">{L_EDIT_CATEGORY}</font></div>
<div class="boxtwo"></div>
<div class="boxthree"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td>
    
    <form action="" method="post" name="rssinput" target="_self"><table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td><div align="left">
      <input name="name" type="text" class="formcss" id="name" value="{NAME}" size="40" maxlength="40" />
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

<!-- END edit-category -->


<!-- BEGIN edit-forum -->
<div class="boxone"><font class="navfont">{L_EDIT_FORUM}</font></div>
<div class="boxtwo"></div>
<div class="boxthree"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td>
    
    <form action="" method="post" target="_self"><table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td><div align="left">
      <input name="name" type="text" class="formcss" size="40" maxlength="40" id="name" value="{NAME}" />
      &nbsp;</div></td>
  </tr>
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_INFO}:</font></div></td>
    <td><div align="left">
      <input name="info" type="text" class="formcss" size="40" maxlength="60" id="info" value="{INFO}" />
      &nbsp;</div></td>
  </tr>
<tr>
    <td><div align="left"><font class="normfont">{L_CATEGORY}:</font></div></td>
    <td><div align="left">
      <select size="1" name="category" class="formcss">
        
                                                               {CATEGORIES}           
    
      </select>
    </div></td>
  </tr>
<tr>
    <td><div align="left"><font class="normfont">{L_PARENT}:</font></div></td>
    <td><div align="left">
      <select size="1" name="parent" class="formcss">
        
                                                               {FORUMS}           
    
      </select>
    </div></td>
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
<!-- END edit-forum -->

<!-- BEGIN category-permission -->

<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="5">{CATEGORY_NAME}</td></tr>

<tr class="boxtwo">
<td width="20%"><div align="left" class="navfont">{L_GROUP_LIST}</div></td>
<td width="80%"><div align="left" class="navfont">{L_CURRENT_GROUPS}</div></td>
</tr>
<tr class="row0"><td valign="top">
<form action="" method="post" target="_self">
<select class="formcss" style="width: 100%; margin:1;"name="all-groups" multiple="multiple" size="5">
{ALL_GROUPS}
</select>
<center><input type="submit" name="add" value="{L_ADD}" class="formcss"/></center>
</form>
</td>
<td valign="top">
<form action="" method="post" target="_self">
<select class="formcss" style="width: 100%;" name="current-groups" multiple="multiple" size="5">
{CURRENT_GROUPS}
</select>
<center><input type="submit" name="remove" value="{L_REMOVE}" class="formcss"/></center>
</form>
</td>

</tr>

</table>

<!-- END category-permission -->

<!-- BEGIN forum-permission -->


<!-- BEGIN groups -->









<table width="100%" border="0" cellspacing="2" cellpadding="4">
<tr class="boxone"><td colspan="5">{FORUM_NAME}</td></tr>

<tr class="boxtwo">
<td width="20%"><div align="left" class="navfont">{L_GROUP_LIST}</div></td>
<td width="80%"><div align="left" class="navfont">{L_CURRENT_GROUPS}</div></td>
</tr>
<tr class="row0"><td valign="top">

<form action="" method="post" target="_self">

<select class="formcss" style="width: 100%; margin:1;"name="all-groups" multiple="multiple" size="5">
{ALL_GROUPS}
</select>
<center> <select name="level" class="formcss">
            <option value="1">{L_LIMITED}</option>
            <option value="2">{L_NORMAL}</option>
            <option value="3">{L_FULL}</option>
<option value="4">{L_MODERATOR}</option>

          </select><input type="submit" name="add" value="{L_ADD}" class="formcss"/></center>
</form>


</td>
<td valign="top">

<form action="" method="post" target="_self">
<select class="formcss" style="width: 100%;" name="current-groups" multiple="multiple" size="5">
{CURRENT_GROUPS}
</select>
<center><input type="submit" name="remove" value="{L_REMOVE}" class="formcss"/> <input type="submit" name="edit" value="{L_EDIT}" class="formcss"/></center>
</form>


</td>

</tr>

</table>












<!-- END groups -->
<!-- BEGIN group-edit -->

<form action="" method="post" target="_self">
<div class="boxone"><font class="navfont">{L_PERMISSIONS}</font></div>
<table width = "100%">

<tr>
        <td width="20%"><div align="left"><font class="normfont">{L_POST}:</font></div></td>
        <td><div align="left"><font class="normfont">
          <select name="post" class="formcss">
            <option {POSTYES} value="1">{L_ENABLED}</option>
            <option {POSTNO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
 </tr>

<tr>
        <td><div align="left"><font class="normfont">{L_REPLY}:</font></div></td>
        <td colspan="2"><div align="left"><font class="normfont">
          <select name="reply" class="formcss">
            <option {REPLYYES} value="1">{L_ENABLED}</option>
            <option {REPLYNO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
 </tr>

<tr>
        <td><div align="left"><font class="normfont">{L_POLL}:</font></div></td>
        <td colspan="2"><div align="left"><font class="normfont">
          <select name="poll" class="formcss">
            <option {POLLYES} value="1">{L_ENABLED}</option>
            <option {POLLNO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
 </tr>

<tr>
        <td><div align="left"><font class="normfont">{L_UPLOAD}:</font></div></td>
        <td colspan="2"><div align="left"><font class="normfont">
          <select name="upload" class="formcss">
            <option {UPLOADYES} value="1">{L_ENABLED}</option>
            <option {UPLOADNO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
 </tr>

<tr>
        <td><div align="left"><font class="normfont">{L_MODERATOR}:</font></div></td>
        <td colspan="2"><div align="left"><font class="normfont">
          <select name="moderator" class="formcss">
            <option {MODERATORYES} value="1">{L_ENABLED}</option>
            <option {MODERATORNO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
 </tr>

 <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="Submit" value="{L_SUBMIT}" class="formcss"/>
    </div></td>
  </tr>

</table>

</form>
<!-- END group-edit -->

<!-- END forum-permission -->


<!-- BEGIN normal -->
<table width="100%" cellspacing="2" cellpadding = "4">
<!-- BEGIN category -->
<form action="" method="post" name="category" target="_self">
<tr class="boxone"><td><font class="navfont">{TITLE}
</font><input type="hidden" name="id" value="{ID}"></td></tr>

<tr class="boxtwo"><td><font class="navfont"><input name="catup" type="submit" class="globaltab" value="{L_UP}"/> <input name="catdown"  type="submit" class="globaltab" value="{L_DOWN}"/> <input name="catdel"  type="submit" class="globaltab" value="{L_DELETE}"/> <INPUT TYPE="submit" name="edit-category" value ="{L_EDIT}" class="globaltab">  <INPUT TYPE="submit" name="category-permission" value ="{L_PERMISSIONS}" class="globaltab" style="width:100px;"></font></td></tr>
</form>
<!-- END category -->

<!-- BEGIN row -->
<tr class="row{CLASS}"><td><form action="" method="post" name="row" target="_self"><font class="normfont"><b>{ID} - {TITLE}</b> - {INFO}<div align="right"><input type="hidden" name="id" value="{ID}"><input name="up" type="submit" class="formcss" value="{L_UP}"/><input name="down" type="submit" class="formcss" value="{L_DOWN}"/><input name="edit-forum" type="submit" class="formcss" value="{L_EDIT}"/><input name="empty" type="submit" class="formcss" value="{L_EMPTY}"/><INPUT TYPE="submit" name="forum-permission" value ="{L_PERMISSIONS}" class="formcss"><input name="delete" type="submit" class="formcss"  style="color: #FF0000;" value="{L_DELETE}"/> </font></td></tr></form>
<!-- END row -->

</table>

<!-- END normal -->