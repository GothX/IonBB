<!-- BEGIN edit -->
<form action="" method="post" target="_self">
<div class="boxone"><font class="navfont">{L_EDIT_ACCOUNT}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%">
<tr>
<td>
<center>
{AVI}<br /><input name="avatar-delete" type="submit" class="formcss" value="{L_DELETE}"/>
</center>

</td><td>



<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
   <tr>
    <td width="10%"><div align="left"><font class="normfont">{L_EMAIL}:</font></div></td>
    <td width="40%"><div align="left">
      <input name="email" type="text" class="formcss" value="{EMAIL}" size="30" maxlength="100" />
    </div></td>
<td width="10%"><div align="left"><font class="normfont">{L_PASSWORD}:</font></div></td>
    <td width="40%"><div align="left">
      <input name="password" type="password" class="formcss" size="30" maxlength="40" />
    </div></td>
  </tr>
  <tr><td><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td><div align="left">
      <input name="name" type="text" class="formcss" value="{NAME}" size="30" maxlength="40" />
    </div></td>
    <td><div align="left"><font class="normfont">{L_IP}:</font></div></td>
    <td><div align="left">
  <input name="ip" type="text" class="formcss" value="{IP}" size="30" maxlength="40" readonly="readonly" />
    </div></td>
  </tr>



    <tr>
 <td><div align="left"><font class="normfont">{L_STATUS}:</font></div></td>
    <td><div align="left"><font class="normfont">
      <select size="1" name="status" class="formcss" >
        <option {ACTIVE} value="0">{L_ENABLED}</option>
        <option {FROZEN} value="1">{L_DISABLED}</option>
      </select>
    </font></div></td> 

<td><div align="left"><font class="normfont">{L_RANK}:</font></div></td>
    <td><div align="left"><font class="normfont">
       <select name="rank" class="formcss">
        
        {RANKS}
      
      </select>
    </font></div></td>  </tr>
</table>

    
    
    </td>
  </tr>
</table>

 </td>
  </tr>
</table>


</div>
</div>


<div class="bodyline">
<div class="boxone"><font class="navfont">{L_SIGNATURE}</font></div>
<center> <textarea rows="2" name="signature" cols="20" style="width: 97%; height: 100" class="formcss" >{SIGNATURE}</textarea>
   </center>
</div>

<div class="bodyline">
<div class="boxone"><font class="navfont">{L_NOTES}</font></div>
<center><textarea rows="2" name="notes" cols="20" style="width: 97%; height: 100" class="formcss" >{NOTES}</textarea></center>
</div>




<div class="bodyline">
<div align="center"><input name="Submit" type="submit" class="formcss" value="{L_SUBMIT}"/></div>

</div>
</form>

<!-- END edit -->




<!-- BEGIN select -->






<div class="boxone">{L_SELECT_USER}</div>
<form action="" method="post" target="_self">
<center>
<table width="400">
<tr>
    <td><div align="left">
      <select name="account_select" class="formcss" style="width:100%">
        
        {ACCOUNT_SELECT}
      
      </select></div></td>
<td><input type="submit" name="Submit" value="{L_SUBMIT}" class="formcss"/></td>
  </tr>
</table>
</center>
</form>
</div><div class="bodyline">




<div class="boxone"><font class="navfont">{L_SEARCH_USERS}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>
    
    <form action="" method="post" name="email" target="_self"><table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_EMAIL}:</font></div></td>
    <td width="49%"><div align="left"><font class="normfont">
<input name="email" type="text" class="formcss" id="email" size="30" maxlength="100" />
    </font>&nbsp;</div></td>
<td><div align="left">
      <input name="searchemail" type="submit" class="formcss" value="{L_SUBMIT}"/>
    </div></td>
  </tr>
</table>
</form>
    
    
    </td>
  </tr>
  <tr>
    <td>
    
    <form action="" method="post" name="name" target="_self"><table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td width="49%"><div align="left"><font class="normfont">
<input name="name" type="text" class="formcss" id="name" size="30" maxlength="100" />
    </font>&nbsp;</div></td><td><div align="left">
      <input name="searchname" type="submit" class="formcss" value="{L_SUBMIT}"/>
    </div></td>
  </tr>

</table>
</form>
    
    
    </td>
  </tr>
</table></div>

<!-- END select -->

