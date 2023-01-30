<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");
include("../includes/connect.inc.php");
include("../calendario/calendar1.js");
?>

<table cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="center" valign="middle" height="200">
    Seleciona o per&iacute;odo desejado para atualiza&ccedil;&atilde;o no Site:
    <br />
	<form action="iniciar2.php" method="post" name="f">
    <input type="text" name="d1" id="d1" value="" readonly="readonly" />
	<a href='javascript:cal1.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>
		<script language='JavaScript'>
				<!--
				var cal1 = new calendar1(document.f.d1);
				cal1.year_scroll = true;
				//cal1.time_comp = true;
				//-->
		</script>
    
    
    a 
    <input type="text" name="d2" id="d2" value="" readonly="readonly" />
	<a href='javascript:cal2.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>
		<script language='JavaScript'>
				<!--
				var cal2 = new calendar1(document.f.d2);
				cal2.year_scroll = true;
				//cal1.time_comp = true;
				//-->
		</script>
    &nbsp;
    <input type="submit" name="sb" value="Iniciar Atualiza&ccedil;&otilde;es"  />
    </form>
    </td></tr>
</table>


<?php
include("../includes/rodape.inc.php");
?>