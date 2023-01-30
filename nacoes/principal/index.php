<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");

//echo $_SESSION['cook_banco'];

?>


<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="350">
		

		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
		 <tr>
		  <td align="center" valign="center">
			   <a href="../cadastro_aluno/cadastro_aluno.php">
               <img src="../img/logo_matricula.gif" width="148" height="197" border="0"> </a>
		  <td align="center" valign="center">
			   <a href="../cadastros/index.php">
               <img src="../img/logo_cadastros.gif" width="148" height="197" border="0"> </a>
		 <tr>
		  <td align="center" valign="center">
			   <a href="../relatorios/index.php">
               <img src="../img/logo_relatorios.gif" width="148" height="197" border="0"> </a>
		  <td align="center" valign="center">
			   <a href="../turmas/turmas.php">
               <img src="../img/logo_turmas.gif" width="148" height="197" border="0"> </a>
		</table>


		</td>
  </tr>
</table>
<br>

<?php

include("../includes/rodape.inc.php");

?>
