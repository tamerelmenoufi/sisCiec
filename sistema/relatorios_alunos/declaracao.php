<?php

include("../includes/connect.inc.php");
include("../includes/data.inc.php");
include("../includes/data_ext.inc.php");


	$query = "select a.nome,a.rg,a.rg_orgao,b.descricao, b.codigo as cursos, c.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);
//	echo $query;
	$dados = mysql_fetch_object($result);
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
	font-size: 25px;
	font-weight: none;
	text-decoration: none;

}

.times40 {
	font-family: arial;
	font-size: 40px;
	font-weight: none;
	text-decoration: none;
}

</style>
<html>
<head>
<title>DECLARA«√O DE MATRÌCULA</title>
</head>

<body>
<fieldset style="width:20cm; height:29.7cm; border:#000000 5px solid"><br>

<?php include("../includes/topoDoc.php"); ?>

<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
Autorizado pela <?=$conf[resolucao]?> <br>
Manaus ñ Amazonas </h4>
<p align="center">&nbsp; </p>
<p align="center" class="times25">DECLARA&Ccedil;&Atilde;O </p>
<p align="center">
<p class="times16" align="justify" style="width:95%; margin-left:80px; border:0px solid #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Declaramos para os devidos fins que  
  <?=$dados->nome?>
, portador(a) da carteira de identidade n&ordm; 
<?=$dados->rg?> 
<?=$dados->rg_orgao?>, est&aacute; matriculado(a) no Exame de Educa&ccedil;&atilde;o de Jovens e Adultos &ndash; EJA, n&iacute;vel de 
<?=$dados->descricao?> 
nos termos do Artigo 38 da Lei Federal n&ordm; 9394/96 e Legisla&ccedil;&atilde;o em vigor.<br>
O aluno concluiu as disciplinas abaixo relacionadas:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
	  $sql = "select b.codigo as cod_disciplina, concat(b.descricao,' ',a.observacao) as descricao,a.situacao,a.nota,a.data_exame from matricula a
	            left join cadastro_disciplinas b on a.codigo_disciplina=b.codigo
				left join turmas c on a.codigo_turma=c.codigo
				where a.codigo_aluno='$cod' and a.situacao='AP' and a.codigo_curso='$dados->cursos'
				group by b.descricao order by b.descricao";
//	  echo $sql;
	  $sqlr = mysql_query($sql);
	  $array_disciplinas_concluidas = false;
	  while($dados1 = mysql_fetch_object($sqlr)){
	  
	  	$array_disciplinas_concluidas_cod[] = $dados1->cod_disciplina;
	    $array_disciplinas_concluidas_des[] = $dados1->descricao;
	}
	
echo "&nbsp;".@implode("<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$array_disciplinas_concluidas_des);

?>
.

<br><br>

<?php
	
	$query = "select * from cadastro_disciplinas where codigo_curso='$dados->cursos'".(is_array($array_disciplinas_concluidas_cod) ? " and codigo not in(".@implode(', ',$array_disciplinas_concluidas_cod).")" : false);
//	echo $query;
	$result = mysql_query($query);
	$array_disciplinas = false;
	while($d = mysql_fetch_object($result)){
		$array_disciplinas[] = trim($d->descricao);	
	}
	
	//echo "count: ".count($array_disciplinas);
	
	if(count($array_disciplinas) and trim($array_disciplinas[0])){
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Restando&nbsp; a(s) disciplina(s) 
(<?php
echo @implode(", ",$array_disciplinas);

?>) para a conclus&atilde;o do Curso
<?php
if($data and $data!= 'undefined'){
?>
, com previs&atilde;o de t&eacute;rmino em 
<?php
	$data = str_replace("/","-",$_GET[data]);
	$data = data_formata($data);
	echo trim(data_ext($data));
  }
}
?>
.</p>
</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<p align="center" class="times16">
  <?=data()?>
. </p>
</fieldset>
</body>
</html>
