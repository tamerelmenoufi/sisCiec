<?php

include("../includes/connect.inc.php");
include("../includes/data.inc.php");

include("../includes/data_ext.inc.php");


if($_POST[guardar_documento]){
	mysql_query("insert into docs set codigo_aluno = '".$_POST[cod]."', codigo_curso='".$_POST[curso]."', data='".date("Y-m-d")."', tipo='declaracao_eliminacao', observacao='".$_POST[observacao]."'");	
}

if($_POST[observacao]){
  $observacoes = str_replace("\n","<br>",$_POST[observacao]);
}


	$query = "select a.*,d.data_exame, b.descricao from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and b.codigo='$curso' order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);
	
	$dados = mysql_fetch_object($result);


  if($dados->rg){
      $linha1 = "DOC. IDENT.: ".$dados->rg;
      $linha2 = "ORG&Atilde;O/UF: ".$dados->rg_orgao;
      $linha3 = "CIDADE: ".$dados->cidade;
      $linha4 = "NASCIMENTO: ".data_formata($dados->data_nascimento);
  }elseif($dados->certidao_nascimento){
      $linha1 = "CERT. NASC.: ".$dados->certidao_nascimento;
      $linha2 = "Livro/Folha: ".$dados->certidao_nascimento_livro."/".$dados->certidao_nascimento_folha;     
      $linha3 = "CIDADE: ".$dados->cidade;
      $linha4 = "NASCIMENTO: ".data_formata($dados->data_nascimento);
  }elseif($dados->rne){
      $linha1 = "DOC. RNE: ".$dados->rne;
      $linha2 = "Nacionalidade: ".$dados->nacionalidade;
      $linha3 = false;
      $linha4 = false;
  }elseif($dados->passaporte){
      $linha1 = "No. Passaporte.: ".$dados->passaporte;
      $linha2 = "Nascionalidade: ".$dados->nacionalidade;    
      $linha3 = false;
      $linha4 = false;
  }

	
?>
<style type="text/css">

.times16 {
	font-family: arial;
	font-size: 16px;
	font-weight: none;
	text-decoration: none;
}

.times16 {
	font-family: arial;
	font-size: 14px;
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

.borda1x {
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
.arial10 {font-family: arial;
  font-size: 12px;
  font-weight:bold;
  text-decoration: none;
}
</style>
<html>
<head>
<title>DECLARAÇÃO DE ELIMINAÇÃO DE DISCIPLINAS
</title>
</head>

<body>
<fieldset style="width:20cm; height:29.7cm; border:#000000 5px solid;"><br>

<?php include("../includes/topoDoc.php"); ?>
<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
Autorizado pela <?=$conf[resolucao]?>
Curso Reconhecido pela Resolução n° 49/2016 de 30.03.2016 CEE/AM.<br>
Exames Autorizados pela Resolução 214/2017, de 20.12.2017 e Resolução 211/2022, de 06.12.2022<br>
Manaus – Amazonas </h4>
<p align="center">&nbsp; </p>
<p align="center" class="times30"><span class="times16">DECLARA&Ccedil;&Atilde;O DE ELIMINA&Ccedil;&Atilde;O DE DISCIPLINAS</span><br>
<span class="times16">(N&atilde;o vale como Certificado de Conclus&atilde;o)</span></p>
<p align="center"><span class="times16"><br>
</span><span class="times16">DECLARAMOS PARA OS DEVIDOS FINS QUE </span></p>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="borda1x">
      <tr>
        <td><span class="times16">NOME:
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
    <td><span class="times16">FILIA&Ccedil;&Atilde;O</span></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="borda1x">
      <tr>
        <td><span class="times16">PAI: 
          <?=$dados->nome_pai?>
</span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="2" class="bordasemtop">
      <tr>
        <td><span class="times16">M&Atilde;E:  <?=$dados->nome_mae?></span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="616" height="25"  border="0" cellpadding="2" cellspacing="0" class="borda1x">
      <tr>
        <td height="25" class="bordaright"><span class="times16">INSCRI&Ccedil;&Atilde;O:</span> <span class="times18">
          <?=$dados->codigo?>
        </span></td>
        <td class="bordaright"><span class="times16"><?=$linha4?></span></td>
        <td class=""><span class="times16"><?=$linha3?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="616" height="27"  border="0" cellpadding="2" cellspacing="0" class="bordasemtop">
      <tr>
        <td height="25" class="bordaright"><span class="times16">UF:  <?=$dados->estado?></span> </td>
        <td class="bordaright"><span class="times16"><?=$linha1?>  </span></td>
        <td class=""><span class="times16"><?=$linha2?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="times18" align="justify"><p class="times16">PRESTOU EXAME SUPLETIVO DO <span class="times16"><span class="times25">
      <?=$dados->descricao?></span></span>, TENDO OBTIDO AS SEGUINTES NOTAS DE APROVA&Ccedil;&Atilde;O DE ACORDO A LEGISLA&Ccedil;&Atilde;O VIGENTE: </p></td>
  </tr>
</table>
<br>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td ><table width="100%"  border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="borda1x"><div align="center" class="times16"><strong>DISCIPLINAS</strong></div></td>
        <td class="borda1x"><div align="center" class="times16"><strong>NOTA</strong></div></td>
        <td class="borda1x"><div align="center" class="times16"><strong>NOTA POR EXTENSO </strong></div></td>
        <td class="borda1x"><div align="center" class="times16"><strong>DATA</strong></div></td>
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
        <td class="borda1x"><div align="center" class="times16">
            <?=$dados->descricao?>
        </div></td>
        <td class="borda1x"><div align="center" class="times16">
            <?=number_format($dados->nota,1,',',false)?>
        </div></td>
        <td class="borda1x"><div align="center" class="times16">
            <?=escreve_numero(number_format($dados->nota,1,',',false))?>
        </div></td>
        <td class="borda1x"><div align="center" class="times16">
            <?=data_formata($dados->data_exame)?>
        </div></td>
      </tr>
      <?php
		}array_disciplinas
	?>
    </table></td>
  </tr>
</table>
<br>
<p>&nbsp;</p>
<p align="center">&nbsp;
<?php
	
	$query = "select * from cadastro_disciplinas where codigo_curso='$curso'".(is_array($array_disciplinas_concluidas) ? " and codigo not in('".@implode("', '",$array_disciplinas_concluidas)."')" : false);
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

</b></font><font color="#006600"><b>
<?php
}
?>
</b></font></p>
<br>
<p><?=(($observacoes)?'Observa&ccedil;&otilde;es:<br>'.$observacoes:'&nbsp;')?></p>
<p align="center" class="times16">
  <?=(($_POST[data])?data_ext($_POST[data]):data())?>
. </p>
<p>&nbsp; </p>
</fieldset>

<p align="left" class="times30"><span class="times16">
<table align="left" style="width:20cm; margin-top:-100px; margin-left:20px; border-top:#000 solid 1px;">
  <tr>
      <td align="center" class="arial10">
      Djalma Batista<br>
      Ed. Milhomem Center, Av. Djalma Batista, nº 98A<br>
             3023-1242 / 3346-0191 / 99303-9416
        </td>
      <td align="center" class="arial10">
      Shopping São José<br>
      2º Piso em frente a Marisa<br>
            3342-3327/ 99984-8881
        </td>
      <td align="center" class="arial10">
      Parque das Nações<br>
      R. Angola, nº 21. Quadra 23<br>
            3654-2283 / 99434-6959
      </td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="arial10">wm.supletivo.com.br</td>
    </tr>
</table>
</span></p>

</body>
</html>
