<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");
include("../includes/connect.inc.php");
?>
<iframe width='700' height='400' frameborder='0' src='teste.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>'></iframe>
<?php
include("../includes/rodape.inc.php");
?>