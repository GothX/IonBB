<div class="boxone"><font class="navfont">{L_CONFIGURATION}</font></div>

<div class="boxtwo"></div>
<div class="boxthree"><table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>
    
    <form action="" method="post" name="config">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="10px"><div align="left"><font class="normfont">{L_NAME}:</font></div></td>
    <td colspan="3"><div align="left"><input name="name" type="text" class="formcss" id="name" value="{SITEN}" size="40" maxlength="40" /></div></td>
  </tr>
  <tr>
    <td><div align="left"><font class="normfont">{L_URL}:</font></div></td>
    <td colspan="3"><div align="left"><input name="url" type="text" class="formcss" id="url" value="{SITEU}" size="40" maxlength="40" readonly="readonly" /></div></td>
  </tr>
  <tr>
    <td><div align="left"><font class="normfont">{L_PATH}:</font></div></td>
    <td colspan="3"><div align="left"><input name="path" type="text" class="formcss" id="path" value="{SITEP}" size="40" maxlength="40" readonly="readonly" /></div></td>
  </tr>
  <tr>
    <td><div align="left"><font class="normfont">{L_TEMPLATE}:</font></div></td>
    <td colspan="3"><div align="left">
      <select name="template" class="formcss">
        
        
        {SITET}
      
      
      </select>
    </div></td>
  </tr>
 
  <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_SESSION}:</font></div></td>
    <td colspan="3"><div align="left">
      <input name="session_name" type="text" class="formcss" id="session_name" value="{SESSION_NAME}" size="40" maxlength="40" />
    </div></td>
  </tr>
<tr>
    <td width="11%"><div align="left"><font class="normfont">{L_ADMIN_EMAIL}:</font></div></td>
    <td colspan="3"><div align="left">
      <input name="admin_email" type="text" class="formcss" id="admin_email" value="{ADMIN_EMAIL}" size="40" maxlength="80" />
    </div></td>
  </tr> 
   
<tr>
    <td width="11%"><div align="left"><font class="normfont">{L_STATUS}:</font></div></td>
    <td colspan="2"><div align="left"><font class="normfont">
      <select name="sitestatus" class="formcss">
        <option {SYES} value="1">{L_DISABLED}</option>
        <option {SNO} value="0">{L_ENABLED}</option>
      </select>
    </font></div></td>

      </tr>
   <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_DESCRIPTION}:</font></div></td>
    <td colspan="3"><div align="left">
      <input name="metainfo" type="text" class="formcss" id="metainfo" value="{METAINFO}" size="40" maxlength="40" />
    </div></td>
  </tr>
   <tr>
    <td width="11%"><div align="left"><font class="normfont">{L_KEYWORDS}:</font></div></td>
    <td colspan="3"><div align="left">
      <input name="metakeywords" type="text" class="formcss" id="metakeywords" value="{METAKEYWORDS}" size="40" maxlength="40" />
    </div></td>
  </tr>

   
   

<tr>
    <td width="11%"><div align="left"><font class="normfont">{L_FACEBOOK_BUTTON}:</font></div></td>
    <td colspan="2"><div align="left"><font class="normfont">
      <select name="facebook_like" class="formcss">
        <option {FBYES} value="1">{L_ENABLED}</option>
        <option {FBNO} value="0">{L_DISABLED}</option>
      </select>
    </font></div></td>

      </tr>

<tr>
    <td width="11%"><div align="left"><font class="normfont">{L_RSS}:</font></div></td>
    <td colspan="2"><div align="left"><font class="normfont">
      <select name="rss" class="formcss">
        <option {RSSYES} value="1">{L_ENABLED}</option>
        <option {RSSNO} value="0">{L_DISABLED}</option>
      </select>
    </font></div></td>

      </tr>



     
   <tr>
    <td colspan="4"><div align="left"><font class="normfont"><strong>{L_TOS}</strong></font></div></td>
    </tr>

<tr>
    <td colspan="4"><textarea rows="10" name="tos" cols="30" style="width: 98%; height: 300" class="formcss" >{TOS}</textarea></td>
  </tr>
</table>
  
    
    </td>
  </tr>
    
  
      
  <tr>
    <td colspan="4"><div align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="formcss"/></div></td>
  </tr>
</table>
</form>
    
    
</div>

