<!-- BEGIN report -->

<div class="boxone"><font class="navfont">{L_DETAILS}</font></div><div class="boxtwo"></div>
<div class="boxthree">{L_ACCOUNT}: {ACCUSED} <br />{L_REPORTER}: {REPORTER} <br />{L_DATE}: {DATE}<br />{L_WARNINGS}: {WARNINGS} <br />{L_ACTIONED}: {ACTION} 
</div>
<!-- BEGIN content -->
</div><div class="bodyline">
<div class="boxone"><font class="navfont">{L_CONTENT}</font></div><div class="boxtwo"></div>
<div class="boxthree">{CONTENT}
</div>
<!-- END content -->
</div><div class="bodyline">
<div class="boxone"><font class="navfont">{L_REASON}</font></div><div class="boxtwo"></div>
<div class="boxthree">{REASON}
</div>
<!-- BEGIN outcome -->
</div><div class="bodyline">
<div class="boxone"><font class="navfont">{L_OUTCOME}</font></div><div class="boxtwo"></div>
<div class="boxthree">{OUTCOME}
</div>
<!-- END outcome -->

<!-- BEGIN warning -->
</div><div class="bodyline">
<div class="boxone"><font class="navfont">{L_OUTCOME}</font></div>
<div class="boxtwo"></div>
<div class="boxthree">
    

     <table width="100%" border="0" cellspacing="2" cellpadding="4">
<form action="" method="post" name="post" target="_self">

  <tr>

    <td colspan="2"><div align="center">

      <textarea name="warning" id="reason" rows="10" cols="40" style="width: 98%; height: 50" class="formcss"></textarea>

    </div></td>

  </tr>


  <tr>

    <td colspan="2"><div align="center"><input name="Submit" type="submit" value="{L_SEND_WARNING}" class="formcss" /> <input name="Ban" type="submit" value="{L_BAN}" class="formcss" /> <select size="1" name="tempban" class="formcss">
<option value="3600">{L_ONE_HOUR}</option> 
<option value="86400">{L_ONE_DAY}</option> 
<option value="172800">{L_TWO_DAYS}</option> 
<option value="604800">{L_ONE_WEEK}</option> 
<option value="1209600">{L_TWO_WEEKS}</option>    
</select> <input type="submit" name="tban" value="{L_TEMPORARY_BAN}" class="formcss"/> <input name="Close" type="submit" value="{L_CLOSE}" class="formcss" /></div></td>

  </tr></form>

    </table></div>



    

    

<!-- END warning -->


<!-- END report -->



<!-- BEGIN normal -->
<div class="pages"><font class="pagefont">{PAGES}</font></div>
</div><div class="bodyline">




<table width="100%" cellspacing="2" cellpadding="2">
<tr class="boxone"><td colspan="5"   style="padding: 4px">{L_REPORTS}</td></tr>
<tr class="boxtwo">

<td width="10px"><font class="normfont"><center>{L_ID}</center></font></td>
<td><font class="normfont"><center>{L_TYPE}</center></font></td>
<td><font class="normfont"><center>{L_ACCOUNT}</center></font></td>
<td><font class="normfont"><center>{L_REPORTER}</center></font></td>
<td><font class="normfont"><center>{L_DATE}</center></font></td>
</tr>




<!-- BEGIN row -->
<tr class="row{CLASS}">

<td width="10px"><font class="normfont"><center>{ID}</center></font></td>
<td><font class="normfont"><center>{TYPE}</center></font></td>
<td><font class="normfont"><center>{ACCOUNT}</center></font></td>
<td><font class="normfont"><center>{REPORTER}</center></font></td>
<td><font class="normfont"><center>{DATE}</center></font></td>
</tr><!-- END row -->
</table>

</div><div class="bodyline">
<div class="pages"><font class="pagefont">{PAGES}</font></div>
<!-- END normal -->

