<form action="" method="post"target="_self"><div class="boxone"><font class="navfont">{L_USER_SETTINGS}</font></div>
<div class="boxthree">
    <table width="100%" border="0" cellspacing="0" cellpadding="4">
 <tr>
        <td width="120"><div align="left"><font class="normfont">{L_REGISTRATION}:</font></div></td>
        <td colspan="2"><div align="left"><font class="normfont">
          <select name="userreg" class="formcss">
            <option {RYES} value="1">{L_ENABLED}</option>
            <option {RNO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
        <td><div align="left"><font class="normfont">{L_REGISTRATION_MSG}</font></div></td>
      </tr>  
<tr>
        <td width="120"><div align="left"><font class="normfont">{L_ACTIVATION}:</font></div></td>
        <td colspan="2"><div align="left"><font class="normfont">
          <select name="activation" class="formcss">
            <option {AYES} value="1">{L_ENABLED}</option>
            <option {ANO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
        <td><div align="left"><font class="normfont">{L_ACTIVATION_MSG}</font></div></td>
      </tr>     
<tr>
        <td><div align="left"><font class="normfont">{L_IP_LOCK}:</font></div></td>
        <td colspan="2"><div align="left"><font class="normfont">
          <select name="iplock" class="formcss">
            <option {IPYES} value="1">{L_ENABLED}</option>
            <option {IPNO} value="0">{L_DISABLED}</option>
          </select>
        </font></div></td>
        <td><div align="left"><font class="normfont">{L_IP_LOCK_MSG}</font></div></td>
      </tr>
      <tr>
    <td><div align="left"><font class="normfont">{L_USER_TEMPLATE}:</font></div></td>
    <td colspan="2"><div align="left">
      <select name="template" class="formcss">
        <option {UTYES} value="1">{L_ENABLED}</option>
        <option {UTNO} value="0">{L_DISABLED}</option>
      </select>
 </div></td>
    <td><div align="left"><font class="normfont">{L_USER_TEMPLATE_MSG}</font></div></td>
      </tr>
   
   
       <tr>
    <td colspan="4"><div align="center"><input name="submit" type="submit" class="formcss" value="{L_SUBMIT}"/></div></td>
  </tr>
      
  

</table>

    
</div>








</form>
