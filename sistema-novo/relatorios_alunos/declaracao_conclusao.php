<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/data.inc.php");
include("../includes/data_ext.inc.php");


  function verifica_certificacao($disciplina,$cod,$curso){ 
	  $query = "select codigo_disciplina from matricula where codigo_aluno='$cod' and codigo_curso='$curso' and situacao='AP'";
	  $result = mysql_query($query);
	  while($dados = mysql_fetch_object($result)){
		if($dados->codigo_disciplina == $disciplina){
		  $retorno = true;
		}
	  }
	  return $retorno;
   }


if($_POST[observacao]){
	$observacoes = str_replace("\n","<br>",$_POST[observacao]);
}



	$query = "select a.nome,a.rg,a.rg_orgao,a.estado,a.cidade,a.data_nascimento,b.descricao, b.codigo as cursos, c.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and b.codigo='$d' order by c.data_exame desc limit 0,1";

	$query = "select a.*,b.descricao, b.codigo as cursos, d.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and b.codigo='$d' order by d.data_exame desc limit 0,1";



	$result = mysql_query($query);
	$dados = mysql_fetch_object($result);
	//echo $query;


	if($dados->rg){
	  $linha1 = " natural de ".$dados->cidade."/".$dados->estado.", portador(a) da Carteira de Identidade n&ordm; ".$dados->rg." ".$dados->rg_orgao;
	
	}elseif($dados->rne){
		  $linha1 = "nacionalidade ".$dados->nacionalidade.", portador(a) da RNE n&ordm; ".$dados->rne;

}elseif($dados->rnm){
			$linha1 = "nacionalidade ".$dados->nacionalidade.", portador(a) da RNM n&ordm; ".$dados->rnm;
	}elseif($dados->passaporte){
		  $linha1 = "nacionalidade ".$dados->nacionalidade.", portador(a) do Passaporte n&ordm; ".$dados->passaporte;
	
}elseif($dados->certidao_nascimento){
	$linha1 = " natural de ".$dados->cidade.", Unidade Federada ".$dados->estado.", portador(a) da Certid&atilde;o de Nascimento n&ordm; ".$dados->certidao_nascimento.", Livro/Folha ".$dados->certidao_nascimento_livro."/".$dados->certidao_nascimento_folha;   
}

    if(!mysql_num_rows($result)){
     $retorno = true;
    }


   $sql = "select codigo from cadastro_disciplinas where codigo_curso='$dados->cursos'";
   //echo $sql;
   $sql = mysql_query($sql);
        if(!mysql_num_rows($sql)){
         $retorno = true;
        }

    while($ds = mysql_fetch_object($sql)){
	  if(!verifica_certificacao($ds->codigo,$cod,$dados->cursos)){
	    $retorno = true;
	  }
   }

   if($retorno and !$fec){
		echo "<br><br><br><br><br><br><center>A Declara��o n�o pode ser emitida, Aluno(a) N�o concluiu as disciplinas obrigat�rias!<br><br><a href='javascript:window.close()'>Voltar</a></center>"; exit;
		//include("mensagem_historico.php");
		//exit;
   }






?>
<style type="text/css">

.times16 {
	font-family: arial;
	font-size: 16px;
	font-weight: none;
	text-decoration: none;
}

.borda_tabela{
	border: solid 1px #000000;
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
.arial10 {font-family: arial;
	font-size: 12px;
	font-weight:bold;
	text-decoration: none;
}
</style>
<html>
<head>
<title>DECLARA��O DE MATR�CULA</title>
</head>

<body>
<fieldset style="width:20cm; height:29.7cm; border:#000000 5px solid;"><br>

<?php include("../includes/topoDoc.php"); ?>

<h4 align="center" class="times16">EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA <br>
<b style="font-weight:100!important"><?=$Dicionario['resolucao']?></b></h4>
<p align="center">&nbsp; </p>
<p align="center" class="times25">DECLARA&Ccedil;&Atilde;O DE CONCLUS&Atilde;O</p>
<p align="center">
<p class="times16" align="justify" style="width:85%; margin-left:80px; border:0px solid #000000">
<span style="margin-left:95px;">Declaramos para os devidos fins que  
  <?=$dados->nome?>
, <strong> </strong><?=$linha1?>, nascido(a) no dia <?=trim(data_ext($dados->data_nascimento,''))?>, concluiu, em 
              <?=trim(data_ext($dados->data_exame,''))?>, os Exames da Educa��o de Jovens e Adultos- EJA, do 
<?=$dados->descricao?>, 
nos termos do Artigo 38 da Lei Federal n&ordm; 9394/96 e Legisla&ccedil;&atilde;o em vigor, estando apto a prosseguir seus estudos.
<br>
<table style="margin:10px;" width="100%" class="borda_tabela" cellpadding="5" cellspacing="0">
	<tr style="margin:10px;text-align:center">
    	<td class="borda_tabela"><span class="times16" style="font-weight:bold;">Disciplinas</span></td>
        <td class="borda_tabela"><span class="times16" style="font-weight:bold;">Nota Obtida</span></td>
	</tr>
<?php
	  $query = "select b.codigo as cod_disciplina, concat(b.descricao,' ',a.observacao) as descricao,a.situacao,a.nota,a.data_exame from matricula a
	            left join cadastro_disciplinas b on a.codigo_disciplina=b.codigo
				left join turmas c on a.codigo_turma=c.codigo
				where a.codigo_aluno='$cod' and a.situacao='AP' and a.codigo_curso='$dados->cursos'
				group by b.descricao order by b.ordem";
	  $result = mysql_query($query);
	  $array_disciplinas_concluidas = false;
	  $i = 0;
	  while($dados = mysql_fetch_object($result)){
	  
	  	$array_disciplinas_concluidas_cod[] = $dados->cod_disciplina;
	    $array_disciplinas_concluidas_des[] = $dados->descricao;
	    $array_disciplinas_concluidas_not[] = $dados->nota;
?>
    <tr>
        <td class="borda_tabela"><?=$array_disciplinas_concluidas_des[$i]?></td>
        <td class="borda_tabela" align="center"><?=number_format($array_disciplinas_concluidas_not[$i],1,',',false)?></td>
    </tr>
<?php	
/*echo $array_disciplinas_concluidas_des[$i]."<br></span>";
echo $array_disciplinas_concluidas_not[$i]."<br>"; 
*/
$i++;
	}
?>
</table>
</span>
<span style="margin-left:95px;">Seu Certificado de Conclus�o encontra-se em processo de registro e expedi��o.</span>
</p>
<p><?=(($observacoes)?'Observa&ccedil;&otilde;es:<br>'.$observacoes:'&nbsp;')?></p>
<p align="right" style="padding-right:30px" class="times16">
  <?=data()?>
. </p>
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
