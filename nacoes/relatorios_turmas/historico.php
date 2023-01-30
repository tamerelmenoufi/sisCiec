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
	font-size: 12px;
	font-weight: none;
	text-decoration: none;
}

.times18 {
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
	font-size: 20px;
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
</style>
<html>
<head>
<title>HISTÓRICO</title>
</head>

<body>

<?php

$sql = "select codigo_aluno from matricula where codigo_turma='$cod'";
$sql_r = mysql_query($sql);
$numero_de_paginas = mysql_num_rows($sql_r);
$i=0;
while(list($cod) = mysql_fetch_row($sql_r)){


echo '<fieldset style="width:20cm; height:29.7cm; border:#000000 5px solid"><br>';

include("../includes/topoDoc.php");


	$query = "select a.nome,a.cidade,a.estado,a.data_nascimento,a.nome_pai,a.nome_mae,a.rg,a.rg_orgao,a.codigo,b.codigo as curso,b.descricao,d.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);
	
	$dados = mysql_fetch_object($result);
	$curso = $dados->curso;

?>

<h4>&nbsp;</h4>
<p>&nbsp; </p>
<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
Autorizado pela <?=$conf[resolucao]?> <br>
Manaus – Amazonas </h4>
<p align="center"><span class="times26">HIST&Oacute;RICO</span><br>
</p>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="borda1">
      <tr>
        <td><span class="times18">NOME:
            <?=$dados->nome?>
        </span> </td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><span class="times18">FILIA&Ccedil;&Atilde;O</span></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="borda1">
      <tr>
        <td><span class="times18">PAI: 
          <?=$dados->nome_pai?>
</span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="bordasemtop">
      <tr>
        <td><span class="times18">M&Atilde;E:  <?=$dados->nome_mae?></span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="616" height="25"  border="0" cellpadding="2" cellspacing="0" class="borda1">
      <tr>
        <td width="236" height="25" class="bordaright"><span class="times18">INSCRI&Ccedil;&Atilde;O:</span> <span class="times18">
          <?=$dados->codigo?>
        </span></td>
        <td width="272" class="bordaright"><span class="times18">NASCIMENTO: <?=data_formata($dados->data_nascimento)?></span></td>
        <td width="94" class=""><span class="times18">CIDADE: <?=$dados->cidade?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="616" height="27"  border="0" cellpadding="2" cellspacing="0" class="bordasemtop">
      <tr>
        <td width="85" height="25" class="bordaright"><span class="times18">UF:  <?=$dados->estado?></span> </td>
        <td width="281" class="bordaright"><span class="times18">DOC. IDENT.: <?=$dados->rg?>  </span></td>
        <td width="236" class=""><span class="times18">ORG&Atilde;O/UF:<?=$dados->rg_orgao?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><span class="times20"><span class="times25">
    </span></span></td>
  </tr>
</table>
<br>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td >
	
	<table width="100%"  border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="borda1"><div align="center" class="times20"><strong>CURSO</strong></div></td>
        <td class="borda1"><div align="center" class="times20"><strong>DISCIPLINAS</strong></div></td>
        <td class="borda1"><div align="center" class="times20"><strong>NOTA</strong></div></td>
        <td class="borda1"><div align="center" class="times20"><strong>NOTA POR EXTENSO </strong></div></td>
        <td class="borda1"><div align="center" class="times20"><strong>DATA</strong></div></td>
        <td class="borda1"><div align="center" class="times20"><strong>SITUA&Ccedil;&Atilde;O</strong></div></td>
      </tr>
      <?php
	  $query = "select concat(b.descricao,' ',a.observacao) as descricao,a.situacao,a.nota,c.data_exame,d.descricao as curso,a.situacao from matricula a
	            left join cadastro_disciplinas b on a.codigo_disciplina=b.codigo
				left join turmas c on a.codigo_disciplina=c.codigo_disciplina
				left join cadastro_cursos d on a.codigo_curso=d.codigo
				where a.codigo_aluno='$cod'
				group by b.codigo order by d.descricao,b.descricao";

	  $result = mysql_query($query);
	  while($dados = mysql_fetch_object($result)){
	?>
      <tr>
        <td class="borda1"><div align="center" class="times20">
          <?=$dados->curso?>
        </div></td>
        <td class="borda1"><div align="center" class="times20">
          <?=$dados->descricao?>
        </div></td>
        <td class="borda1"><div align="center" class="times20">
          <?=number_format($dados->nota,1,',',false)?>
        </div></td>
        <td class="borda1" align="center"><span class="times20">
          <?=escreve_numero(number_format($dados->nota,1,',',false))?>
        </span></td>
        <td width="105" class="borda1"><div align="center" class="times20">
          <?=data_formata($dados->data_exame)?>
        </div></td>
        <td class="borda1"><div align="center"><span class="times20">
            <?=$dados->situacao?>
        </span></div></td>
      </tr>
      <?php
		}
	?>
    </table>
	
	
	
	</td>
  </tr>
</table>
<br>
<p align="center" class="times20">
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
