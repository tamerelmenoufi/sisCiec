<?php
include("../includes/validar_usuario.inc.php");
?>

<html lang='pt-BR' dir='ltr'>
<head>
<meta charset="utf-8" />
<title></title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;

}

.borda_right { 
border-right: solid 1px #c1c1c1;
 }
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 24px; }
-->
</style>
</head>
<body>
<div align="center">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" height="57" background="../img/bg_topo.gif"><img src="../img/logo_wm.gif"></td>
        </tr>

     
        <tr>
          <td><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"  >
            <tr bgcolor="#FFFFFF">
              <td height="15" border="0" valign="top">
			<?php

			 if($_SESSION[cook_logado]){
			    include("../menu_java/menu.php");   
				}else { echo "&nbsp;"; }
			  ?></td>
              <td align="center" valign="middle" bgcolor="#F7F5F6">
			  <?php
			   if($ferramentas){
			   include("ferramentas.inc.php");  
			   }else { echo "&nbsp;"; }
			  ?>
			  <table width="680"  border="0" cellspacing="10" >
                <tr>
                  <td>
