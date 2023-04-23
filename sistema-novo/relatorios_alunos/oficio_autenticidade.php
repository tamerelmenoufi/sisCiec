<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/data.inc.php");

include("../includes/data_ext.inc.php");


			     $query = "select unidade,livro,folha,data,ordem,observacao from certificados where codigo_curso='$curso' and codigo_aluno='$cod'";
				 $result = mysql_query($query);
				 list($unidade,$livro,$folha,$data_doc,$ordem,$observacao) = mysql_fetch_row($result);			  


	$query = "select a.nome,a.rg,a.rg_orgao,a.data_nascimento,a.cidade,a.estado,b.descricao,d.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and d.codigo_curso='$curso' and d.situacao = 'AP' and d.codigo_turma=c.codigo order by d.data_exame desc limit 0,1";
	$result = mysql_query($query);
	$dados = mysql_fetch_object($result);
	
	$validar_curso = strtolower($dados->descricao);
	

if($_SESSION[cook_observacoes]){
	$observacoes = str_replace("\n","<br>",$_SESSION[cook_observacoes]);
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
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>OFÍCIO DE AUTENTICIDADE
</title>
</head>

<body>
<fieldset style="width:20cm; padding-left:10px; height:29.7cm; border:#000000 5px solid ;"><br>

<?php include("../includes/topoDoc.php"); ?>
<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
<b style="font-weight:100!important"><?=$Dicionario['resolucao']?></b>  </h4>
<p align="center"><hr> </p>
<p align="left" class="times30"><span class="times16">&Agrave;</span></p>
<p align="left" class="times30"><?=$_SESSION[cook_instituicao]?></p>
<p align="left" class="times30"><?=$_SESSION[cook_departamento]?></p>
<p align="left" class="times30"><?=$_SESSION[cook_responsavel]?></p>
<p align="left" class="times30"><?=$_SESSION[cook_cargo]?></p>
<p align="left" class="times30">Nesta<span class="times16"></span></p>
<p align="right"><span class="times16"><?=data()?>.</span></p>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div style="border:#009 solid 0px; width:100%; min-height:600px;">
<p align="justify" class="times30">
<span style="margin-left:50px;"></span>Pelo presente <strong>ratificamos</strong> que <strong><?=trim($dados->nome)?></strong> concluiu o Exame de Educa&ccedil;&atilde;o de Jovens e Adultos - EJA, do <?=trim($dados->descricao)?>, estando seu Certificado de Conclus&atilde;o do <?=trim($dados->descricao)?> registrado no Livro n° <?=$livro?>, folha <?=$folha?>, em <?=data_ext($data_doc,'')?>
<?php
	if($validar_curso == 'ensino mï¿½dio'){
?>
; e seu nome publicado na Rela&ccedil;&atilde;o de Alunos Concludentes da EJA, no Di&aacute;rio Oficial do Estado do Amazonas, edi&ccedil;&atilde;o de <?=data_ext($_SESSION[cook_data_oficio],'')?>, Caderno de Publica&ccedil;&otilde;es Diversas, p&aacute;gina <?=$_SESSION[cook_pagina_oficio]?>. 


<?php
	}else{
?>
.
<?php
	}
?>


<p>&nbsp;</p>

<p><span style="margin-left:50px;"></span>Limitado ao exposto, reiteramos votos de considera&ccedil;&atilde;o.</p>

<p><?=(($observacoes)?'Observa&ccedil;&otilde;es:<br>'.$observacoes:'&nbsp;')?></p>

									<p><span style="margin-left:50%;"></span>Atenciosamente,</p>


</p>
</div>


</fieldset>


<p align="left" class="times30"><span class="times16">
<table align="left" style="width:20cm; margin-top:-100px; margin-left:20px; border-top:#000 solid 1px;">
<tr>
    	<td align="center" class="arial10">
			<?=$Dicionario['rodape_endereco_djalma']?>
        </td>
    	<td align="center" class="arial10">
		<?=$Dicionario['rodape_endereco_leste']?>
        </td>
    	<td align="center" class="arial10">
		<?=$Dicionario['rodape_endereco_nacoes']?>
      </td>
    </tr>
    <tr>
    	<td colspan="3" align="center" class="arial10">wm.supletivo.com.br</td>
    </tr>
</table>
</span></p>


</body>
</html>
