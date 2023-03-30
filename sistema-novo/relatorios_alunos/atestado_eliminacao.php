<?php

include("../includes/connect.inc.php");
include("../includes/data.inc.php");
include("../includes/data_ext.inc.php");



if($_POST[guardar_documento]){
	mysql_query("insert into docs set codigo_aluno = '".$_POST[cod]."', codigo_curso='".$_POST[curso]."', data='".date("Y-m-d")."', tipo='atestado_eliminacao', observacao='".$_POST[observacao]."'");
}

if($_POST[observacao]){
	$observacoes = str_replace("\n","<br>",$_POST[observacao]);
}

	$query = "select a.*,b.descricao,d.data_exame from cadastro_aluno a "
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and b.codigo='$curso' order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);

	$dados = mysql_fetch_object($result);

  if($dados->rg){
      $linha1 = "RG ".$dados->rg;
      $linha2 = "ORG&Atilde;O/UF: ".$dados->rg_orgao;
      $linha3 = "CIDADE: ".$dados->cidade;
      $linha4 = "NASCIMENTO: ".data_formata($dados->data_nascimento);
  }elseif($dados->rne){
	$linha1 = "RNE ".$dados->rne;
	$linha2 = "Nacionalidade: ".$dados->nacionalidade;
	$linha3 = false;
	$linha4 = false;
  }elseif($dados->rnm){
	$linha1 = "RNM ".$dados->rnm;
	$linha2 = "Nacionalidade: ".$dados->nacionalidade;
	$linha3 = false;
	$linha4 = false;
  }elseif($dados->passaporte){
      $linha1 = "No. Passaporte.: ".$dados->passaporte;
      $linha2 = "Nascionalidade: ".$dados->nacionalidade;
      $linha3 = false;
      $linha4 = false;
  }elseif($dados->certidao_nascimento){
      $linha1 = "CERT. NASC.: ".$dados->certidao_nascimento;
      $linha2 = "Livro/Folha: ".$dados->livro."/".$dados->folha;
      $linha3 = "CIDADE: ".$dados->cidade;
      $linha4 = "NASCIMENTO: ".data_formata($dados->data_nascimento);
  }



?>


<html>
<head>

<style type="text/css">

.times16 {
	font-family: arial;
	font-size: 16px;
	font-weight: none;
	text-decoration: none;
}

.times20 {
	font-family: arial;
	font-size: 20px;
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
border: solid 1px #000000;
}
.arial10 {font-family: arial;
	font-size: 12px;
	font-weight:bold;
	text-decoration: none;
}
</style>
<title>Atestado de eliminação de disciplinas</title>
</head>

<body>

<fieldset style="width:20cm; height:29.7cm; border:#000000 5px solid">
<br>
<br>


<?php include("../includes/topoDoc.php"); ?>
<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
<b style="font-weight:100!important">Amparado pela <?=$conf[resolucao]?>
Curso Reconhecido pela Resolução n° 49/2016 de 30.03.2016 CEE/AM.<br>
Exames Autorizados pela Resolução 214/2017, de 20.12.2017 e Resolução 211/2022, de 06.12.2022<br>
Manaus/Amazonas </b></h4>
<p align="center">&nbsp; </p>
<p align="center" class="times30"><span style="font-weight:bold" class="times20">ATESTADO DE ELIMINA&Ccedil;&Atilde;O DE DISCIPLINAS</span><br>
<span class="times16">(N&atilde;o vale como Certificado de Conclus&atilde;o)</span></p>
<p>&nbsp; </p>
<table width="90%" style="margin-left:0px" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><p class="times16" align="justify"
	style="width:100%; margin-left:10px; border:0px solid #000000">
	 <span class="times20" style="margin-left:95px;" ><d style="font-size:16px!important">Atestamos que</d>
      <?=trim($dados->nome)?>,
      </span> natural de
      <?=$dados->cidade?>,
       nascido(a) em
      <?=data_ext($dados->data_nascimento,false)?>,
	  <?=$linha1?>,
	prestou o Exame de Educação de Jovens e Adultos - EJA, do <span class="times20">
      <?=$dados->descricao?>,
    </span> nos termos dos Artigos 37 e 38, seus parágrafos e alíneas, da Lei n° 9394, de 20 de dezembro de 1996, das Resoluções emanadas pelo Conselho Estadual de Educação do Estado do Amazonas - CEE/AM e Legisla&ccedil;&atilde;o em vigor, foi considerado(a) aprovado(a) na(s) seguinte(s) disciplina(s): </p></td>
  </tr>
</table>
</p>
<br>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="borda1x"><table width="100%"  border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td align="center" valign="middle" class="borda1x"><div align="center" class="times16"><strong>DISCIPLINAS</strong></div></td>
        <td align="center" valign="middle" class="borda1x"><div align="center" class="times16"><strong>NOTA</strong></div></td>
        <td align="center" valign="middle" class="borda1x"><div align="center" class="times16"><strong>NOTA POR EXTENSO </strong></div></td>
        <td align="center" valign="middle" class="borda1x"><div align="center" class="times16"><strong>DATA</strong></div></td>
      </tr>
	<?php

	  $query = "select b.codigo as cod_disciplina,concat(b.descricao,' ',a.observacao) as descricao, a.situacao,a.nota,a.data_exame from matricula a
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
        <td align="center" valign="middle" class="borda1x"><div align="center" class="times16"><?=$dados->descricao?></div></td>
        <td align="center" valign="middle" class="borda1x"><div align="center" class="times16"><?=number_format($dados->nota,1,',',false)?></div></td>
        <td align="center" valign="middle" class="borda1x"><div align="center" class="times16"><?=escreve_numero(number_format($dados->nota,1,',',false))?></div></td>
        <td align="center" valign="middle" class="borda1x"><div align="center" class="times16"><?=data_formata($dados->data_exame)?></div></td>
      </tr>
	<?php
		}
	?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center" class="times10">&nbsp;
<?php

	$query = "select * from cadastro_disciplinas where codigo_curso='$curso'".(is_array($array_disciplinas_concluidas) ? " and codigo not in('".@implode("','",$array_disciplinas_concluidas)."')" : false);
	//echo $query;
	$result = mysql_query($query);
	$array_disciplinas = false;
	while($d = mysql_fetch_object($result)){
		$array_disciplinas[] = $d->descricao;
	}

	//echo "count: ".count($array_disciplinas);

	if(count($array_disciplinas) and trim($array_disciplinas[0])){
?>
<font style="color:#FF0000;font-size:15px"><b>
Disciplinas pendentes (<?php
	echo @implode(", ",trim($array_disciplinas));

?>)
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
<p><?=(($observacoes)?'Observa&ccedil;&otilde;es:<br>'.$observacoes:'&nbsp;')?></p>
<p align="center" class="times16">
  <?=data()?>
. </p>

</fieldset>
<p align="left" class="times30"><span class="times16">
<table align="left" style="width:20cm; margin-top:-100px; margin-left:20px; border-top:#000 solid 1px;">
	<tr>
    	<td align="center" class="arial10">
			Djalma Batista<br>
			Ed. Milhomem Center, Av. Djalma Batista, n° 98A<br>
             3023-1242 / 3346-0191 / 99303-9416
        </td>
    	<td align="center" class="arial10">
			Shopping São José<br>
			2° Piso em frente a Marisa<br>
            3342-3327/ 99984-8881
        </td>
    	<td align="center" class="arial10">
			Parque das Nações<br>
			R. Angola, n° 21. Quadra 23<br>
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
