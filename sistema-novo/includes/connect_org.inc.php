<?php
mysql_connect("127.0.0.1","root","");
mysql_select_db("wm");
$conf[resolucao]='Resolu&ccedil;&atilde;o n&ordm; 145/07-CEE/AM, de 11.12.2007';

list($conf[codigo_curso],$conf[unidade]) = mysql_fetch_row(mysql_query("select codigo, descricao from cadastro_escola where op='1'"));


include("../includes/funcoes_php.inc.php");


?>