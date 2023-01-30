<?php
include("../includes/sessoes.inc.php");
if($_SESSION['cook_logado']){ include("./sair.php"); }
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
echo "<form action='login.php' method='post'>";
?>


<style type="text/css">
<!--
.style2 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 24px; }
-->
</style>
<table width="530" border="0" align="center" cellpadding="0" cellspacing="0" class="bordafina_tabela">
  <tr>
    <td align="left" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="90%" colspan="2">&nbsp;</td>
        <td width="5%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="40" colspan="2" valign="middle"><span class="style4"> Controle de acesso </span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="90%" colspan="2"><span class="style2"> Para acessar, voc&ecirc; precisa se identificar: </span></td>
        <td width="5%">&nbsp;</td>
      </tr>
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="90%"><div align="right"><span class="style2">Login: </span></div></td>
        <td width="70%"><span class="style2">
          <input name="login" type="text" id="login3">
        </span></td>
        <td width="5%">&nbsp;</td>
      </tr>
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="90%"><div align="right"><span class="style2">Senha: </span></div></td>
        <td width="70%"><span class="style2">
          <input name="senha" type="password" id="senha3">
        </span></td>
        <td width="5%">&nbsp;</td>
      </tr>
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="90%">&nbsp;</td>
        <td width="100%"><div align="right">
            <input name="image" type="image" src="../img/btn_entrar.gif" width="79" height="22">
		&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="image" type="image" src="../img/seta_titulos.gif" width="27" height="27" title='sair' onclick="window.close();">

        </div></td>
        <td width="5%">&nbsp;</td>
      </tr>
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="90%" colspan="2"><div align="right"><span class="style2">Esqueci minha senha. </span></div></td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
    <td width="30%" align="left" valign="top"><img src="../img/key.gif" width="269" height="180"></td>
  </tr>
</table>
<br>

<?php

include("../includes/rodape.inc.php");
echo "</form>";


?>
