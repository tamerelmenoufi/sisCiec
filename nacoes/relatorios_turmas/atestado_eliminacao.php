<?php

include("../includes/connect.inc.php");
include("../includes/data.inc.php");
include("../includes/data_ext.inc.php");


?>



<style type="text/css">

.times16 {
	font-family: arial;
	font-size: 16px;
	font-weight: none;
	text-decoration: none;
}

.times20 {
	font-family: arial;
	font-size: 14px;
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

.times26 {
	font-family: arial;
	font-size: 16px;
	font-weight: bold;
	text-decoration: none;
}

.borda1 {
border: solid 0px #000000;
text-align:center;
}

</style>
<html>
<head>
<title>ATESTADO DE ELIMINAÇÃO DE DISCIPLINAS</title>
</head>

<body>



<?php

$sql = "select codigo_aluno,codigo_curso from matricula where codigo_turma='$cod'";
$sql_r = mysql_query($sql);
$numero_de_paginas = mysql_num_rows($sql_r);
$i=0;
while(list($cod,$curso) = mysql_fetch_row($sql_r)){

echo '<fieldset style="width:20cm; height:29.7cm; border:#000000 5px solid"><br>';

include("../includes/topoDoc.php"); 

	$query = "select a.nome,a.cidade,a.estado,a.data_nascimento,b.descricao,d.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and b.codigo='$curso' order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);
	
	$dados = mysql_fetch_object($result);
	


?>


<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
Autorizado pela <?=$conf[resolucao]?> <br>
Manaus – Amazonas </h4>
<p align="center">&nbsp; </p>
<p align="center" class="times30"><span class="times26">ATESTADO DE ELIMINA&Ccedil;&Atilde;O DE DISCIPLINAS</span><br>
  <span class="times16">( N&atilde;o vale como Certificado de Conclus&atilde;o)</span></p>
<p>&nbsp; </p>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><p class="times20" align="justify">Atestamos que, <span class="times20">
      <?=$dados->nome?>
      </span>, natural de 
      <?=$dados->cidade?>
      , Unidade Federada 
      <?=$dados->estado?>, nascida em 
      <?=data_ext($dados->data_nascimento)?>, prestou o Exame Supletivo do <span class="times20">
      <?=$dados->descricao?>, 
      </span> nos termos do Artigo 38 da Lei Federal n&ordm; 9.394/96 e Legisla&ccedil;&atilde;o em vigor, foi considerado aprovado na seguinte disciplina: </p></td>
  </tr>
</table>
<p align="center" class="times20"><br>
</p>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="borda1"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="borda1"><div align="center" class="times20"><strong>DISCIPLINAS</strong></div></td>
        <td class="borda1"><div align="center" class="times20"><strong>NOTA</strong></div></td>
        <td class="borda1"><div align="center" class="times20"><strong>NOTA POR EXTENSO </strong></div></td>
        <td class="borda1"><div align="center" class="times20"><strong>DATA</strong></div></td>
      </tr>
	<?php
	  $query = "select b.codigo as cod_disciplina, concat(b.descricao,' ',a.observacao) as descricao,a.situacao,a.nota,a.data_exame from matricula a
	            left join cadastro_disciplinas b on a.codigo_disciplina=b.codigo
				left join turmas c on a.codigo_turma=c.codigo
				where a.codigo_aluno='$cod' and a.situacao='AP' and a.codigo_curso='$curso'
				group by b.codigo order by b.descricao";
	  $result = mysql_query($query);
	  $array_disciplinas_concluidas = false;
	  while($dados = mysql_fetch_object($result)){

	  	$array_disciplinas_concluidas[] = $dados->cod_disciplina;
	  
	?>
      <tr>
        <td class="borda1"><div align="center" class="times20"><?=$dados->descricao?></div></td>
        <td class="borda1"><div align="center" class="times20"><?=number_format($dados->nota,1,',',false)?></div></td>
        <td class="borda1"><div align="center" class="times20"><?=escreve_numero(number_format($dados->nota,1,',',false))?></div></td>
        <td class="borda1"><div align="center" class="times20"><?=data_formata($dados->data_exame)?></div></td>
      </tr>
	<?php
		}
	?>
    </table></td>
  </tr>
</table>
<p class="times25" align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;</p>
<p align="center">&nbsp;
<?php
	
	
	
	$query = "select * from cadastro_disciplinas where codigo_curso='$curso'".(is_array($array_disciplinas_concluidas) ? " and codigo not in(".@implode(', ',$array_disciplinas_concluidas).")" : false);
	//echo $query;
	$result = @mysql_query($query);
	$array_disciplinas = false;
	while($d = @mysql_fetch_object($result)){
		$array_disciplinas[] = $d->descricao;	
	}
	
	//echo "count: ".count($array_disciplinas);
	
	if(count($array_disciplinas) and trim($array_disciplinas[0])){
?>
<font color="#FF0000"><b>
Disciplinas pendentes (
<?php
	echo @implode(", ",$array_disciplinas);
	
?>
) 
<?php
}else{
?>
<font color="#006600"><b>
Sem pend&ecirc;ncia de disciplinas
<?php
}
?>
</b>
</font>
</p>
<br>
<p align="center" class="times20">
  <?=data()?>
. </p>
<?php

 if(($i < ($numero_de_paginas -1))){
	 
	 echo '</fieldset>';
	 echo "\n\n"."<center style=\"page-break-after: always;\"></center>"."\n\n";
	 
 }
 $i++;  }
?>

</body>
</html>
