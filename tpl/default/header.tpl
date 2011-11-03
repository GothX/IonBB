<!DOCTYPE html>
<html>
 <head>
  <title>{PAGETITLE}</title>
  <link rel='stylesheet' href='{URL}tpl/{TPL}/inc/style.css'>
  <script type='text/javascript' src='{URL}inc/jquery.js'></script>
 </head>
 <body>
  <div id='header'>
   <div id='branding'>
    <img src='{URL}tpl/{TPL}/img/logo.png' alt='IonBB'>
   </div>
   <div id='menu'>
    <a href='{URL}'>{L_HOME}</a>
   </div>
   <div id='hbar'></div>
   <div id='page'>
    <div id='userstrip'>
<!-- BEGIN logged_in -->
	{PANEL}
<!-- END logged_in -->
<!-- BEGIN logged_out -->
	{L_GUEST} ( <a href="{URL}?s=login" class="tab">{L_LOGIN}</a> | <a href="{URL}?s=register" class="tab">{L_REGISTER}</a> )
<!-- END logged_out -->
	</div>
	<div id='navstrip'>{SITELINK} / {AREA}</div>