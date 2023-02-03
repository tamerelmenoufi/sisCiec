<?php

include("../includes/connect.inc.php");
include("../includes/data.inc.php");
include("../includes/data_ext.inc.php");
	
?>
<style type="text/css">

.times16 {
	font-family: arial;
	font-size: 18px;
	font-weight: none;
	text-decoration: none;
}

.times25 {
	font-family: arial;
	font-size: 17px;
	font-weight: none;
	text-decoration: none;

}

.times40 {
	font-family: arial;
	font-size: 20px;
	font-weight: none;
	text-decoration: none;
}

</style>
<html>
<head>
<title>DECLARA«√O DE MATRÌCULA</title>
</head>

<body>
<?php

$sql = "select codigo from matricula where codigo_turma='$cod'";
$sql_r = mysql_query($sql);
$numero_de_paginas = mysql_num_rows($sql_r);
$i=0;
while(list($cod) = mysql_fetch_row($sql_r)){

echo '<fieldset style="width:20cm; height:29.7cm; border:#000000 5px solid"><br>';

include("../includes/topoDoc.php");

	$query = "select a.nome,a.rg,a.rg_orgao,b.descricao,c.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where d.codigo = '$cod' order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);
	
	$dados = mysql_fetch_object($result);


?>
<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
Autorizado pela <?=$conf[resolucao]?> <br>
Manaus ñ Amazonas </h4>
<p align="center" class="times16">&nbsp;</p>
<p align="center" class="times40">DECLARA&Ccedil;&Atilde;O </p>
<p class="times25" align="justify" style="width:80%; margin-left:60px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Declaro, para os devidos fins que 
  <?=$dados->nome?>
, portador da carteira de identidade n&ordm; 
<?=$dados->rg?> 
<?=$dados->rg_orgao?>
, encontra-se matriculado no Exame Supletivo do 
<?=$dados->descricao?> 
nesta institui&ccedil;&atilde;o de ensino de acordo com a Legisla&ccedil;&atilde;o em vigor, com previs&atilde;o de t&eacute;rmino em 
<?=data_ext($dados->data_exame)?>
. </p>
<p>&nbsp; </p>
<p align="center" class="times25">
  <?=data()?>
. </p>
<?php

 if(($i < ($numero_de_paginas -1))){
	 echo "\n\n"."<center style=\"page-break-after: always;\"></center>"."\n\n";
	 echo "</fieldset>";
 }
 $i++;  }
?>

</body>
</html>
