<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta name="Description" http-equiv="Description" content="{METAINFO}" /><meta name="Keywords" http-equiv="Keywords" content="{METAKEYWORDS}" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{PAGETITLE}</title><link rel="stylesheet" type="text/css" href="{URL}tpl/{TPL}/inc/style.css" />
<link rel="icon"
      type="image/png"
      href="{URL}/favicon.ico" />
</head><body>
<center>
<div class="bodyline"> <div class="panel"><div class="header"><div class="logo"></div><div class="navigation">
<a href="{URL}" class="tab">{L_HOME}</a> 
<!-- BEGIN logged_out -->
<a href="{URL}?s=register" class="tab">{L_REGISTER}</a> 
<a href="{URL}?s=login" class="tab">{L_LOGIN}</a> 
<!-- END logged_out -->
<!-- BEGIN logged_in -->
<a href="{URL}?s=ucp" class="tab">{L_ACCOUNT}</a> 
<a href="{URL}?s=mail" class="tab">{L_MAIL}</a> 
<a href="{URL}?s=logout" class="tab">{L_LOGOUT}</a> 
<!-- END logged_in -->
</div></div>
<!-- BEGIN logged_in -->
<div style="float: left; clear:all; padding:6px;"><font class="normfont">{PANEL}</font></div>     <div style="float: right;padding:4px;text-align:right;">{GLOBAL_MENU}</div>
<div style="clear:both;"></div><!-- END logged_in --></div>
</div><div class="bar">
<div style="float:left; margin-right: 2px;"><img src="{URL}tpl/{TPL}/img/earth.png" border="0" alt=""/></div><font class="normfont"> {SITELINK} / {AREA}</font>
</div><div class="bodyline">