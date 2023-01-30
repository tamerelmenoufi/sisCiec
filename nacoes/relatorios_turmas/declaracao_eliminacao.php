<?php

include("../includes/connect.inc.php");
include("../includes/data.inc.php");

include("../includes/data_ext.inc.php");
	
?>

<style type="text/css">

.times16 {
	font-family: arial;
	font-size: 14px;
	font-weight: none;
	text-decoration: none;
}

.times20 {
	font-family: arial;
	font-size: 16px;
	font-weight: none;
	text-decoration: none;
}

.times18 {
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

.times26 {
	font-family: arial;
	font-size: 26px;
	font-weight: bold;
	text-decoration: none;
}

.borda1 {
border: solid 0px #000000;
}

.bordasemtop {
border-left: solid 0px #000000;
border-right: solid 0px #000000;
border-bottom: solid 0px #000000;
}

.bordaright {
	border-right: solid 0px #000000;
}


.style2 {font-family: arial; font-size: 18px; font-weight: bold; text-decoration: none; }
.arial16 {font-family: arial;
	font-size: 16px;
	font-weight: none;
	text-decoration: none;
}
.arial18 {font-family: arial;
	font-size: 18px;
	font-weight: none;
	text-decoration: none;
}
.style3 {font-family: arial; font-size: 8px; font-weight: bold; text-decoration: none; }
</style>
<html>
<head>
<title>DECLARAÇÃO DE ELIMINAÇÃO DE DISCIPLINAS
</title>
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



	$query = "select a.nome,a.cidade,a.estado,a.data_nascimento,a.nome_pai,a.nome_mae,a.rg,a.rg_orgao,a.codigo,b.descricao,d.data_exame from cadastro_aluno a " 
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
<p align="center" class="times30"><span class="times20">DECLARA&Ccedil;&Atilde;O DE ELIMINA&Ccedil;&Atilde;O DE DISCIPLINAS</span><br>
<span class="times16">( N&atilde;o vale como Certificado de Conclus&atilde;o)</span></p>
<p align="center"><span class="times20"><br>
</span><span class="times16">DECLARAMOS PARA OS DEVIDOS FINS QUE</span></p>
<p>&nbsp; </p>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="times16"><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="borda1">
      <tr>
        <td><span class="times16">NOME:
            <?=$dados->nome?>
        </span> </td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td class="times16">&nbsp;</td>
  </tr>
  <tr>
    <td class="times16"></td>
  </tr>
  <tr>
    <td class="times16"><span class="times16">FILIA&Ccedil;&Atilde;O</span></td>
  </tr>
  <tr>
    <td class="times16"><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="borda1">
      <tr>
        <td><span class="times16">PAI: 
          <?=$dados->nome_pai?>
</span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="times16"><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="bordasemtop">
      <tr>
        <td><span class="times16">M&Atilde;E:  <?=$dados->nome_mae?></span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="times16">&nbsp;</td>
  </tr>
  <tr>
    <td class="times16"><table width="616" height="25"  border="0" cellpadding="2" cellspacing="0" class="borda1">
      <tr>
        <td height="25" class="bordaright"><span class="times16">INSCRI&Ccedil;&Atilde;O:</span> <span class="times18">
          <?=$dados->codigo?>
        </span></td>
        <td class="bordaright"><span class="times16">NASCIMENTO: <?=data_formata($dados->data_nascimento)?></span></td>
        <td class=""><span class="times16">CIDADE: <?=$dados->cidade?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="times16"><table width="616" height="27"  border="0" cellpadding="2" cellspacing="0" class="bordasemtop">
      <tr>
        <td height="25" class="bordaright"><span class="times16">UF:  <?=$dados->estado?></span> </td>
        <td class="bordaright"><span class="times16">DOC. IDENT.: <?=$dados->rg?>  </span></td>
        <td class=""><span class="times16">ORG&Atilde;O/UF:<?=$dados->rg_orgao?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="times16">&nbsp;</td>
  </tr>
  <tr>
    <td class="times16"><span class="times20"><span class="times25">
    </span></span></td>
  </tr>
</table>
<br>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="times18" align="justify"><p class="times16">PRESTOU EXAME SUPLETIVO EM N&Iacute;VEL DE <span class="times16">
      <strong><?=$dados->descricao?></strong>
    , TENDO OBTIDO AS SEGUINTES NOTAS DE APROVA&Ccedil;&Atilde;O DE ACORDO A LEGISLA&Ccedil;&Atilde;O VIGENTE:</span> </p></td>
  </tr>
</table>
<br>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td ><table width="100%"  border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="borda1"><div align="center" class="times16"><strong>DISCIPLINAS</strong></div></td>
        <td class="borda1"><div align="center" class="times16"><strong>NOTA</strong></div></td>
        <td class="borda1"><div align="center" class="times16"><strong>NOTA POR EXTENSO </strong></div></td>
        <td class="borda1"><div align="center" class="times16"><strong>DATA</strong></div></td>
      </tr>
      <?php
	  $query = "select b.codigo as cod_disciplina, concat(b.descricao,' ',a.observacao) as descricao,a.situacao,a.nota,a.data_exame from matricula a
	            left join cadastro_disciplinas b on a.codigo_disciplina=b.codigo
				left join turmas c on a.codigo_turma=c.codigo
				where a.codigo_aluno='$cod' and a.situacao='AP' and a.codigo_curso='$curso'
				group by b.descricao order by b.descricao";
	  $result = mysql_query($query);
	  $array_disciplinas_concluidas = false;
	  while($dados = mysql_fetch_object($result)){
	  
	  	$array_disciplinas_concluidas[] = $dados->cod_disciplina;
	  
	?>
      <tr>
        <td class="borda1"><div align="center" class="times20">
            <?=$dados->descricao?>
        </div></td>
        <td class="borda1"><div align="center" class="times20">
            <?=number_format($dados->nota,1,',',false)?>
        </div></td>
        <td class="borda1"><div align="center" class="times20">
            <?=escreve_numero(number_format($dados->nota,1,',',false))?>
        </div></td>
        <td class="borda1"><div align="center" class="times20">
            <?=data_formata($dados->data_exame)?>
        </div></td>
      </tr>
      <?php
		}
	?>
    </table></td>
  </tr>
</table>
<br>
<p>&nbsp;</p>
<p align="center">&nbsp;
<?php
	
	$query = "select * from cadastro_disciplinas where codigo_curso='$curso'".(is_array($array_disciplinas_concluidas) ? " and codigo not in(".@implode(', ',$array_disciplinas_concluidas).")" : false);
	//echo $query;
	$result = mysql_query($query);
	$array_disciplinas = false;
	while($d = mysql_fetch_object($result)){
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
<p>&nbsp; </p>
<?php

 if(($i < ($numero_de_paginas -1))){
	 echo "\n\n"."<center style=\"page-break-after: always;\"></center>"."\n\n";
	 echo "</fieldset>";
 }
 $i++;  }
?>

</body>
</html>
