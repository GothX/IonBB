<form action="" method="post" target="_self"><div class="boxone"><font class="navfont">{TITLE}</font></div>
<div class="boxthree">

<div style="float:left; width: 40px; padding: 2px;"><img src="{URL}tpl/proBlue/img/system.png" /></div>
<div style="float:right; padding: 2px; width: 700px; text-align: left;"><font class="normfont">{MESSAGE}</font><br /><center>
<FORM style="padding: 4px; margin: 0px">
{HIDDEN_FIELDS}
<INPUT TYPE="hidden" name="confirmed" value="true"/>
<INPUT TYPE="submit" value ="{L_CONFIRM}" name="{VAR}" class="formcss"/>
<INPUT TYPE="button" value ="{L_CANCEL}" class="formcss" onClick="parent.location='{LINK}'">
</FORM></center></div>
<div style="clear:both;"></div>

</div>