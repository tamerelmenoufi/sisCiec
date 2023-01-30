<?php
//include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/data.inc.php");

include("../includes/data_ext.inc.php");


	$query = "select a.*,b.codigo as curso,b.descricao,d.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and d.codigo_turma=c.codigo order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);
	
	$dados = mysql_fetch_object($result);
	$curso = $dados->curso;
	

  if($dados->rg){
      $linha1 = "DOC. IDENT.: ".$dados->rg;
      $linha2 = "ORG&Atilde;O/UF: ".$dados->rg_orgao;
      $linha3 = "CIDADE: ".$dados->cidade;
      $linha4 = "NASCIMENTO: ".data_formata($dados->data_nascimento);
      $linha5 = "UF:  ".$dados->estado;
  }elseif($dados->certidao_nascimento){
      $linha1 = "CERT. NASC.: ".$dados->certidao_nascimento;
      $linha2 = "Livro/Folha: ".$dados->livro."/".$dados->folha;     
      $linha3 = "CIDADE: ".$dados->cidade;
      $linha4 = "NASCIMENTO: ".data_formata($dados->data_nascimento);
      $linha5 = "UF:  ".$dados->estado;
  }elseif($dados->rne){
      $linha1 = "DOC. RNE: ".$dados->rne;
      $linha2 = "Nacionalidade: ".$dados->nacionalidade;
      $linha3 = false;
      $linha4 = false;
      $linha5 = false;
  }elseif($dados->passaporte){
      $linha1 = "No. Passaporte.: ".$dados->passaporte;
      $linha2 = "Nascionalidade: ".$dados->nacionalidade;    
      $linha3 = false;
      $linha4 = false;
      $linha5 = false;
  }



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

.times12 {
	font-family: arial;
	font-size: 12px;
	font-weight: none;
	text-decoration: none;
}

.times18 {
	font-family: arial;
	font-size: 12px;
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
.style8 {font-family: arial; font-size: 12px; font-weight: bold; text-decoration: none; }
.arial10 {font-family: arial;
  font-size: 12px;
  font-weight:bold;
  text-decoration: none;
}


</style>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>ESPELHO</title>
</head>

<body>
<fieldset style="width:20cm; height:29.7cm; border:#000000 5px solid"><br>

<?php include("../includes/topoDoc.php"); ?>

<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
Autorizado pela <?=$conf[resolucao]?> <br>
Manaus – Amazonas </h4>
<p align="center"><span class="times26">ESPELHO</span><br>
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
    <td><table width="616" height="50"  border="0" cellpadding="2" cellspacing="0" class="borda1">
      <tr>
        <td height="25" class="bordaright"><span class="times18">INSCRI&Ccedil;&Atilde;O:</span> <span class="times18">
          <?=$dados->codigo?>
        </span></td>
        <td class="bordaright"><span class="times18"><?=$linha3?></span></td>
        <td class=""><span class="times18"><?=$linha4?></span></td>
      </tr>
      <tr>
        <td height="23" class="bordaright">&nbsp;</td>
        <td class="bordaright">&nbsp;</td>
        <td class="">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="616" height="27"  border="0" cellpadding="2" cellspacing="0" class="bordasemtop">
      <tr>
        <td height="25" class="bordaright"><span class="times18"><?=$linha5?></span> </td>
        <td class="bordaright"><span class="times18"><?=$linha1?>  </span></td>
        <td class=""><span class="times18"><?=$linha2?> </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="times20"><span class="times25">
    </span></span></td>
  </tr>
</table>
<br>
<br>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td >
	
	<table width="100%"  border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td align="center" class="borda1"><div align="center" class="times12"><strong>ESCOLA</strong></div></td>
        <td align="center" class="borda1"><div align="center" class="times12"><strong>CURSO</strong></div></td>
        <td align="center" class="borda1"><div align="center" class="times12"><strong>DISCIPLINAS</strong></div></td>
        <td align="center" class="borda1"><div align="center" class="times12"><strong>NOTA</strong></div></td>
      <!--  <td align="center" class="borda1"><div align="center" class="times12"><strong>NOTA POR EXTENSO </strong></div></td> -->
        <td align="center" class="borda1"><span class="times12"><strong>DATA</strong></span></td>
        <td align="center" class="borda1"><span class="style8">SITUA&Ccedil;&Atilde;O</span></td>
      </tr>
      <?php
	  $query = "select concat(b.descricao,' ',a.observacao) as descricao,a.situacao,a.nota,a.data_exame,d.descricao as curso,a.situacao,e.descricao as escola, a.codigo_curso, a.codigo_disciplina  from matricula a
				left join cadastro_cursos d on a.codigo_curso=d.codigo
                                left join cadastro_escola e on e.codigo=a.codigo_escola
	                        left join cadastro_disciplinas b on a.codigo_disciplina=b.codigo
				left join turmas c on a.codigo_turma=c.codigo
				where a.codigo_aluno='$cod' and a.situacao != 'MT' and a.codigo_turma=c.codigo order by d.descricao,b.descricao";
	  $result = mysql_query($query);

	  while($dados = mysql_fetch_object($result)){

           if($dados->situacao == 'AP'){
		   $_Curso[$dados->codigo_curso] = $dados->codigo_curso;
           $_CursoNome[$dados->codigo_curso] = $dados->curso;
		   $Nomes[$dados->codigo_curso][] = trim($dados->descricao);
           $_Disciplinas[$dados->codigo_curso][] = $dados->codigo_disciplina;
		   }
           //echo "<br>".$dados->codigo_curso."<br>".$dados->codigo_disciplina."<br>";


	?>
      <tr>
        <td align="center" class="borda1"><div align="center" class="times12">
          <?=$dados->escola?>
        </div></td>
        <td align="center" class="borda1"><div align="center" class="times12">
          <?=$dados->curso?>
        </div></td>
        <td align="center" class="borda1"><div align="center" class="times12">
          <?=$dados->descricao?>
        </div></td>
        <td align="center" class="borda1"><div align="center" class="times12">
          <?=number_format($dados->nota,1,',',false)?>
        </div></td>
       <!-- <td align="center" class="borda1"><span class="times12">
          <?=escreve_numero(number_format($dados->nota,1,',',false))?>
        </span></td> -->
        <td width="90" align="center" class="borda1"><div align="center" class="times12">
          <?=data_formata($dados->data_exame)?>
        </div></td>
        <td align="center" class="borda1"><span class="times12">
          <?=$dados->situacao?>
        </span></td>
      </tr>
      <?php
		}
	?>
    </table>
	
	





<p align="center">&nbsp;
<?php

foreach($_Curso as $key => $val){	

$query3 = "select * from cadastro_disciplinas where codigo_curso='$val'".(is_array($_Disciplinas[$val]) ? " and codigo not in('".@implode("', '",$_Disciplinas[$val])."')" : false);
	//echo $query3;
	$result3 = mysql_query($query3);
	$array_disciplinas = false;
	
	//print_r($Nomes);
	
	while($d3 = mysql_fetch_object($result3)){
		if(!@in_array(trim($d3->descricao), $Nomes[$val])){
		$array_disciplinas[] = trim($d3->descricao);	
		}
	}
	
	//echo "count: ".count($array_disciplinas);
	
	if(count($array_disciplinas) and trim($array_disciplinas[0])){
?>
<font color="#FF0000"><b>
Disciplinas pendentes curso <?=$_CursoNome[$val]?> (
<?php
	echo @implode(", ",$array_disciplinas);
	
?>
) 
<?php
}else{
?>
<font color="#006600"><b>
Sem pend&ecirc;ncia de disciplinas no curso <?=$_CursoNome[$val]?> 

</b></font><font color="#006600"><b>
<?php
}
?>
</b></font></p>

<?php
}
?>

	
	</td>
  </tr>
</table>
<br>
<br>
<p align="center" class="times20">
  <?=data()?>
. </p>
</fieldset>

<p align="left" class="times30"><span class="times16">
<table align="left" style="width:20cm; margin-top:-100px; margin-left:20px; border-top:#000 solid 1px;">
  <tr>
      <td align="center" class="arial10">
      Djalma Batista<br>
      Milhomem Center, Av. Djalma Batista, nº 98A<br>
             3023-1242 / 3346-0191 / 3236-4048
        </td>
      <td align="center" class="arial10">
      Shopping São José<br>
      2º Piso em frente ao DETRAN<br>
            3342-3327
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
