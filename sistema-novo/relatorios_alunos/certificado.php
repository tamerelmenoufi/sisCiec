<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/data.inc.php");
include("../includes/data_ext.inc.php");


			     $query = "select unidade,livro,folha,data,ordem,observacao from certificados where codigo_curso='$curso' and codigo_aluno='$cod'";
				 $result = mysql_query($query);
				 list($unidade,$livro,$folha,$data_doc,$ordem,$observacao) = mysql_fetch_row($result);


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

if(!$fec){ // condição para forçar a emissão do certificado
   $query = "select codigo from cadastro_disciplinas where codigo_curso='$curso'";
   $result = mysql_query($query);
    while($dados = mysql_fetch_object($result)){
	  if(!verifica_certificacao($dados->codigo,$cod,$curso)){
	    $retorno = true;
	  }
   }

   if($retorno){
		//echo "ainda não terminou !!!";
		include("mensagem_historico.php");
		exit;
   }
}// fim do fec

	$query = "select a.*,b.descricao, d.data_exame from cadastro_aluno a "
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and d.codigo_curso='$curso' and d.situacao = 'AP' and d.codigo_turma=c.codigo order by d.data_exame desc limit 0,1";
	$result = mysql_query($query);
	$dados = mysql_fetch_object($result);

  $validar_curso = strtolower($dados->descricao);

  if($dados->rg){
    $linha1 = "<!--nacionalidade ".$dados->nacionalidade.", --> natural de ".$dados->cidade."/".$dados->estado.", portador(a) da Carteira de Identidade n&ordm; ".$dados->rg." ".$dados->rg_orgao;

  }elseif($dados->rne){
      $linha1 = " nacionalidade ".$dados->nacionalidade.", portador(a) da RNE n&ordm; ".$dados->rne;

  }elseif($dados->passaporte){
      $linha1 = " nacionalidade ".$dados->nacionalidade.", portador(a) do Passaporte n&ordm; ".$dados->passaporte;
   }elseif($dados->certidao_nascimento){
    $linha1 = "<!--nacionalidade ".$dados->nacionalidade.", --> natural de ".$dados->cidade.", ".$dados->estado.", portador(a) da Certid&atilde;o de Nascimento n&ordm; ".$dados->certidao_nascimento.", Livro/Folha ".$dados->certidao_nascimento_livro."/".$dados->certidao_nascimento_folha;
   }

?>

<style type="text/css">
<!--
.times18 {
	font-family: "Times New Roman", Times, serif;
	font-size: 28px;
	font-weight: none;
	text-decoration: none;
}

.times12 {
	font-family: "Times New Roman", Times, serif;
	font-size: 13px;
	font-weight: none;
	text-decoration: none;
}
.corpo {
	font-family:Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: none;
	text-decoration: none;
}

.dauphin {
	font-family:Dauphin;
	font-size: 88px;
	font-weight: none;
	text-decoration: none;
	text-align:center;
}
.dauphin16{
	font-family:Dauphin;
	font-size: 24px;
	font-weight: none;
	text-decoration: none;
	text-align:justify;
}

.dauphin12{
	font-family:Dauphin;
	font-size: 18px;
	font-weight: none;
	text-decoration: none;
	text-align:center;
}

.nota{
	font-family:Dauphin;
	font-size: 9px;
	font-weight: none;
	text-decoration: none;
	text-align:left;
        margin-top:13px;
        margin-left:5px;
        position:absolute;
}

.style1 {color: #0000FF}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{
white-space:nowrap;
}
.borda1 {border: solid 1px #000000;
}
.borda2 {border: solid 2px #000000;
}
.style3 {font-family: "Times New Roman", Times, serif; font-size: 14px; font-weight: bold; text-decoration: none; }
-->
</style>

<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="965"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="20"><img src="../img/canto1_borda_certificado.gif" width="29" height="29"></td>
        <td background="../img/canto8_borda_certificado.gif"><img src="../img/canto8_borda_certificado.gif" width="100%" height="29"></td>
        <td width="20"><img src="../img/canto2_borda_certificado.gif" width="29" height="29"></td>
      </tr>
      <tr>
        <td><img src="../img/canto5_borda_certificado.gif" width="29" height="610"></td>
        <td><table style="background:url(../img/ciecbg.png) no-repeat  center;background-size:100%;"
         width="900"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="73"><img src="../img/logo_ciec.gif" width="120" ></td>
                  <td>
                    <div align="center"><span class="times18"><span class="style1">CENTRO INTEGRADO DE EDUCACÃO E CIDADANIA - CIEC </span><br>
	      EDUCAÇÃO DE JOVENS E ADULTOS - EJA </span><br>
	      <span class="times12">
		 Av. Djalma Batista, nº 98 A, salas 200/201/202/218, 2º andar, Parque Dez de Novembro. CEP 69055-038 Manaus/AM<br>
		Amparado pela <?=$conf[resolucao]?> 
    Curso Reconhecido pela Resolução n° 49/2016 de 30.03.2016 CEE/AM.<br>
    Exames Autorizados pela Resolução 214/2017, de 20.12.2017 e Resolução 211/2022, de 06.12.2022<br>
              Manaus-Amazonas </span></div></td>
                </tr>
              </table>
                <div align="center"></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>

          </tr>
          <tr>
            <td><div class="dauphin"> Certificado </div></td>
          </tr>
          <tr>
            <td class="dauphin16">&nbsp;</td>
          </tr>
          <tr>
            <td class="dauphin16" style="white-space:normal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Certificamos que
              <b><?=trim($dados->nome)?></b>,<?=$linha1?>,
               nascido(a) no dia
              <?=trim(data_ext($dados->data_nascimento,''))?>,
               tendo em vista os resultados obtidos no Exame de Educa&ccedil;&atilde;o de Jovens e Adultos - EJA concluiu em
              <?=trim(data_ext($dados->data_exame,''))?>,
              o
              <?=trim($dados->descricao)?>,
               conforme prescreve a legisla&ccedil;&atilde;o em vigor.</td>
          </tr>
          <tr>
            <td style="font-size:14px" align="left"><b>&nbsp;<?=$segunda?></b></td>
          </tr>
          <tr>
            <td align="right" class="dauphin16"><div align="right"><?=((!$segunda_via) ? data_ext($data_doc) : data())?>.</div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="100%" height="19"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="300" height="19"><div align="center">.........................................................................</div></td>
                  <td>&nbsp;</td>
                  <td width="300"><div align="center">.........................................................................</div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" height="19"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="300" height="19" class="dauphin12">SECRETARIA</td>
                  <td><div align="center">.........................................................................</div></td>
                  <td width="300" class="dauphin12">DIRETOR</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" height="38"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="19">&nbsp;</td>
                  <td class="dauphin12">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="300" height="19">&nbsp;</td>
                  <td width="300" class="dauphin12">ALUNO</td>
                  <td width="300">&nbsp;</td>
                </tr>





            </table>
<?php
	if($curso == 'N_CN_2' or $curso == 'N_CN_4'){
?>
<div class="nota">NOTA: A validade deste documento está condicionada à publicação do nome do aluno concluinte no Diário Oficial do Estado do Amazonas, pela instituição de ensino.</div>
<?php
	}
?>







</td>
</tr>

        </table></td>





        <td><img src="../img/canto7_borda_certificado.gif" width="29" height="610"></td>
      </tr>
      <tr>
        <td width="20"><img src="../img/canto4_borda_certificado.gif" width="29" height="29"></td>
        <td background="../img/canto6_borda_certificado.gif" ><img src="../img/canto6_borda_certificado.gif" width="100%" height="29"></td>
        <td width="20"><img src="../img/canto3_borda_certificado.gif" width="29" height="29"></td>
      </tr>
    </table>


<br><br>
	<?php //aqui entra a quebra de página ?>
        <p>&nbsp;</p>

    <div style="background:url(../img/ciecbg.png) no-repeat  center;background-size:90%;">

        <table width="100%" cellspacing="0" cellpadding="0" class="borda1">
	  <tr>
        <td height="35" colspan="4" align="center" valign="top" class="times12"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="73" style="border-bottom: 1px solid #000000;">&nbsp;</td>
              <td align="left" style="border-bottom: 1px solid #000000;"><div align="center"><span class="times12"><img src="../img/logo_ciec.jpg" width="75" align="left" />CENTRO INTEGRADO DE EDUCAÇÃO E CIDADANIA - CIEC <br />
		EDUCAÇÃO DE JOVENS E ADULTOS - EJA </span><br />
		Av. Djalma Batista, nº 98 A, salas 200/201/202/218, 2º andar, Parque Dez de Novembro. CEP 69055-038 Manaus/AM<br>
                Amparado pela
                <?=$conf[resolucao]?>
                Curso Reconhecido pela Resolução n° 49/2016 de 30.03.2016 CEE/AM.<br>
      Exames Autorizados pela Resolução 214/2017, de 20.12.2017 e Resolução 211/2022, de 06.12.2022<br>
              </div></td>
            </tr>
        </table></td>
	    </tr>
	  <tr>
        <td height="35" colspan="4" align="center" valign="top" class="times12" style="border-bottom: 1px solid #000000;">Componentes Curriculares</td>
	    </tr>

      <tr>
        <td height="35" class="times12" style="border-bottom: 1px solid #000000;">Disciplinas</td>
        <td align="center" style="border-bottom: 1px solid #000000;"><strong>Data</strong></td>
        <td align="center" class="times12" style="border-bottom: 1px solid #000000;">Unidade Federada</td>
        <td align="center" style="border-bottom: 1px solid #000000;"><strong>Registros e Observações</strong></td>
      </tr>
	<?php

	     //$query = "select codigo,descricao from cadastro_disciplinas where codigo_curso='$curso'";
		 //$result = mysql_query($query);
		 //while($dados = mysql_fetch_object($result)){

		 	$sql = " select a.exibe_dia, a.exibe_mes, a.exibe_ano, a.data_exame,a.nota,c.descricao, c.unidade_federada, concat(d.descricao,' ',a.observacao) as disc from matricula a "
			      ." left join turmas b on a.codigo_turma=b.codigo "
				  ." left join cadastro_escola c on c.codigo=a.codigo_escola "
				  ." left join cadastro_disciplinas d on a.codigo_disciplina=d.codigo "
				  ." where  a.situacao='AP' and a.codigo_aluno='$cod' and a.codigo_curso='$curso' and a.codigo_turma=b.codigo order by d.ordem";
			$sql_r = mysql_query($sql);
                        $qb = 0;
			while(list($exibe_dia,$exibe_mes,$exibe_ano,$data_exame,$nota,$escola, $unidade_federada, $disciplina)=mysql_fetch_row($sql_r)){



	?>
            <tr>
        <td width="320" height="25" class="times12"><?=$disciplina?> </td>
        <?php

		  $compdata = false;


                   if(!$exibe_dia and !$exibe_mes and !$exibe_ano ){

		        //$compdata[] = substr($data_exame,-2);
		        $compdata[] = substr($data_exame,5,2);
		        $compdata[] = substr($data_exame,0,4);

                   }else{

		       //if($exibe_dia){ $compdata[] = substr($data_exame,-2); }
		       if($exibe_mes){ $compdata[] = substr($data_exame,5,2); }
		       if($exibe_ano){ $compdata[] = substr($data_exame,0,4); }

                   }

		   $data_exame = @implode("/",$compdata);


        ?>




        <td width="104"><div align="center" class="times12"><?=$data_exame?></div></td>
        <td width="72" class="times12" align="center"><?=$unidade_federada?> </td>
        <td width="413"><div align="center" class="times12"><?//=number_format($nota,1,',',false)?></div></td>
      </tr>
	<?php
          $qb++;
		}
	?>
    </table>
   

        <?php
			if(trim($observacao)){
		?>
        <br />

          <div align="center" style="border:#000000 solid 1px; width:98%; margin-left:20px;">
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td valign="top" align="left" style="font-family:Times New Roman, Times, serif; font-size:13px; font-weight:bold;">Observa&ccedil;&otilde;es</td>
              </tr>
              <tr>
                <td valign="top" align="left" style="font-family:Times New Roman, Times, serif; font-size:10px; font-weight:normal; white-space:normal;"><?=$observacao?></td>
              </tr>
            </table>
          </div>
          <?php
		  }
		  ?>

    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="403" height="130" align="left">
        <style>
			#carimbo {font-family:Arial, Helvetica, sans-serif; widows:400px; text-align:center}
			#carimbo span { color:#999; font-size:12px; font-weight:bold; }
			#carimbo div { color:#999; font-size:11px; font-weight:normal; margin-top:10px; }

		</style>
       <?php
        if($validar_curso == 'ensino médio'){
        ?>
        <div id="carimbo" style="font-size:12px">
        <span>CENTRO INTEGRADO DE EDUCACÃO E CIDADANIA - CIEC<br />
		CIEC SUL - UNIDADE DESCENTRALIZADA<br /></span>
		<p><div>Nome do Aluno Registrado na Listagem do Di&aacute;rio Oficial do Estado</div>
		<div>do Amazonas, Edi&ccedil;&atilde;o de ______/_____/_____, Caderno,</div>
 		<div>de Publica&ccedil;&otilde;es Diversas, P&aacute;gina ______.</div></p>
        </div>
        <?php
         }
         ?>
        </td>
        <td>&nbsp;</td>
        <td valign="middle" align="center"><div align="center">
          <table width="320" height="70"  border="0" cellpadding="0" cellspacing="0">
            <tr >
              <td height="33%" class="borda2"><div align="center"><span class="style3">CERTIFICADO REGISTRADO NO <br />
                LIVRO
                <?=$livro?>
                FOLHA N&ordm;
                <?=$folha?>
                <br />
                EM
                <?=data_formata($data_doc)?>
                  </span><br />
                No. <?=$unidade?>.<?=$livro?>.<?=$folha?>.<?=$ordem?>
              </div></td>
            </tr>
          </table>
        </div>

          </td>
      </tr>
    </table>
    </td>
  </tr>
</table>

	<?php //aqui entra a 2º quebra de página
	if ($dados->descricao == 'Ensino Fundamental'){
	?>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
    <?php
    }else if($qb <= 8){
    ?>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	

    <?php
    }else if($qb <= 11){
    ?>
	<p>&nbsp;</p>

    <?php
    }
	?>

  </div>

  <div style="background:url(../img/ciecbg.png) no-repeat  center;background-size:90%;">

    <table width="100%" cellspacing="0" cellpadding="0">
	  <tr>
        <td height="35" colspan="6" align="center" valign="top" class="times12">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" align="center">
                      <div align="center" style="font-size:10px;margin-top:25">
                        <span class="times12"><img src="../img/logo_ciec.jpg" width="75" align="left" />
                            CENTRO INTEGRADO DE EDUCAÇÃO E CIDADANIA - CIEC <br />
                            EDUCAÇÃO DE JOVENS E ADULTOS - EJA </span><br />
			    Av. Djalma Batista, nº 98 A, salas 200/201/202/218, 2º andar, Parque Dez de Novembro. CEP 69055-038 Manaus/AM<br>
			    Amparado pela <?=$conf[resolucao]?>
          Curso Reconhecido pela Resolução n° 49/2016 de 30.03.2016 CEE/AM.<br>
    Exames Autorizados pela Resolução 214/2017, de 20.12.2017 e Resolução 211/2022, de 06.12.2022<br>
                      </div>
                  </td>
                </tr>
                <!-- <tr>
                  <td colspan="4">&nbsp;</td>
                </tr> -->
                <tr>
                    <td colspan="4" height="35" align="center" valign="middle" class="times12">HIST&Oacute;RICO ESCOLAR - EJA</td>
                </tr>
                <!-- <tr>
                  <td colspan="4">&nbsp;</td>
                </tr> -->
                <tr style="font-size:10px; font-weight:bold">
                    <td width="12%"  class="times12">Nome:</td>
                  <td width="32%" class="corpo" style="font-size:10px; font-weight:bold"><?=$dados->nome?></td>
                  <td width="18%" class="times12" style="font-size:10px; font-weight:bold">Data de Nascimento:</td>
                  <td width="38%" class="corpo" style="font-size:10px; font-weight:bold"><?=data_formata($dados->data_nascimento)?></td>
              <tr>
                <tr style="font-size:12px;font-weight:bold">
                    <td class="times12">RG:</td>
                    <td class="corpo" style="font-size:10px; font-weight:bold"><?=$dados->rg?></td>
                    <td class="times12" style="font-size:10px; font-weight:bold">&Oacute;rg&atilde;o Expedidor:</td>
                    <td class="corpo" style="font-size:10px; font-weight:bold"><?=$dados->rg_orgao?></td>
                <tr>
                <tr style="font-size:12px;font-weight:bold">
                    <td class="times12">N&iacute;vel de ensino:</td>
                    <td class="corpo" style="font-size:10px; font-weight:bold"><?=$dados->descricao?></td>
                    <td class="times12" >Modalidade:</td>
                    <td class="corpo">Educação de Jovens e Adultos/EJA | <b>Etapa Única</b></td>
                <tr>
                <div style="padding:3px"></div>
            </table>
        </td>
        </tr>

      <tr>
        <td height="35" colspan="6" align="center" valign="top" class="times12">
	    <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="borda1">
          <tr>
          <tr>
            <td height="25" class="times12" style="border-bottom: 1px solid #000000;">Disciplinas</td>
            <td align="center" class="times12" style="border-bottom: 1px solid #000000;"><strong>Data</strong></td>
            <td align="center" class="times12" style="border-bottom: 1px solid #000000;">Escola</td>
            <td align="center" class="times12" style="border-bottom: 1px solid #000000;"><strong>C.H.</strong></td>
            <td align="center" class="times12" style="border-bottom: 1px solid #000000;"><strong>Origem</strong></td>
            <td align="center" class="times12" style="border-bottom: 1px solid #000000;"><strong>Nota</strong></td>
            <td align="center" class="times12" style="border-bottom: 1px solid #000000;"><strong>Resultado</strong></td>
          </tr>
          </tr>
	<?php

	     //$query = "select codigo,descricao from cadastro_disciplinas where codigo_curso='$curso'";
		 //$result = mysql_query($query);
		 //while($dados = mysql_fetch_object($result)){

		 	$sql = " select a.exibe_dia, a.exibe_mes, a.exibe_ano, a.data_exame,a.nota,a.carga_horaria,c.descricao,concat(d.descricao,' ',a.observacao) as disc from matricula a "
			      ." left join turmas b on a.codigo_turma=b.codigo "
				  ." left join cadastro_escola c on c.codigo=a.codigo_escola "
				  ." left join cadastro_disciplinas d on a.codigo_disciplina=d.codigo "
				  ." where  a.situacao='AP' and a.codigo_aluno='$cod' and a.codigo_curso='$curso' and a.codigo_turma=b.codigo order by d.ordem";
			$sql_r = mysql_query($sql);
      $total_pontos = 0;
      $quantidade_pontos = 0;
			while(list($exibe_dia,$exibe_mes,$exibe_ano,$data_exame,$nota,$carga_horaria,$escola,$disciplina)=mysql_fetch_row($sql_r)){
      $total_pontos = $total_pontos + $nota;
      $quantidade_pontos++;


	?>
            <tr>
        <td width="320" height="17" class="times12"><?=$disciplina?> </td>
        <?php

		  $compdata = false;


                   if(!$exibe_dia and !$exibe_mes and !$exibe_ano ){

		        $compdata[] = substr($data_exame,-2);
		        $compdata[] = substr($data_exame,5,2);
		        $compdata[] = substr($data_exame,0,4);

                   }else{

		       if($exibe_dia){ $compdata[] = substr($data_exame,-2); }
		       if($exibe_mes){ $compdata[] = substr($data_exame,5,2); }
		       if($exibe_ano){ $compdata[] = substr($data_exame,0,4); }

                   }

		   $data_exame = @implode("/",$compdata);


        ?>
           
           <td width="104" class="times12"><div align="center" class="times12"><?=$data_exame?></div></td>
        <td width="413" class="times12" align="center"><?=$escola?> </td>
        <td width="72" class="times12"><div align="center" class="times12"><?=$carga_horaria?></div></td>
        <td width="72" class="times12" align="center"><?=(($carga_horaria) ? 'Curso' : 'Exame')?></td>
        <td width="72" class="times12"><div align="center" class="times12"><?=number_format($nota,1,',',false)?></div></td>
        <td width="72" class="times12" align="center">Aprovado</td>

        <!--<td width="72" class="times12"><div align="center" class="times12"><?//=$carga_horaria?></div></td>-->

        <!--<td width="72" class="times12" align="center"><?//=(($carga_horaria) ? 'Curso' : 'Exame')?></td>-->
      </tr>
	<?php
		}
	?>


      <tr>
        <td width="150" height="17" class="times12" style="border-bottom: 1px solid #000;border-top: 1px solid #000;font-weight:bold">Total de Pontos  </td>
        
        <td width="413" class="times12" align="center" colspan="4" style="border: solid 1px #000; border-left:0px;border-bottom:0px;border-right:0px"></td>
        <td width="104" class="times12" colspan="4" style="border: solid 1px #000;font-weight:bold;border-bottom:0px;border-right: 0px"><div align="center"  class="times12"><?=number_format($total_pontos, 2, ',', false)?></div></td>
      </tr>

      <tr>
        <td width="150" height="17" class="times12" style="font-weight:bold">Coeficiente </td>
        
        <td width="413" class="times12" align="center" colspan="4"
        style="border: solid 1px #000;border-left:0px;border-bottom:0px;border-right:0px"></td>
        <td width="104" class="times12" colspan="4" style="border: solid 1px #000; border-right: 0px;font-weight:bold;border-bottom:0px"><div align="center" class="times12"><?=number_format($total_pontos/$quantidade_pontos, 2, ',', false)?></div></td>
      </tr>

    </table>
    </td>
    </tr>

    </table>

    <div style="padding:3px;border-bottom: 1px solid #000; border-top:1px solid #000;
text-align:center;font-weight:bold;margin-top:5px">
Observações
</div>


    <div style="border-bottom: 1px solid #000; border-top:1px solid #000;font-size:10px;padding:3px">
     <b>Resolução de autorização para Exames de EJA emanadas pelo Conselho Estadual de Educação do Estado do Amazonas - CEE/AM </b> :
  Resolução n° 38/05, de 26.04.2005/ Resolução 96/06 de 19.09.2006/ Resolução 71/07, de 02.07.2007/ Resolução 92/07, de 08.08.2007/ Resolução 145/07, de 11.12.2007/ Resolução 179/2011, de 20.12.2011/ Resolução 213, de 20.09.2013/ Resolução 49/2016, de 30.03.2016/ Resolução 159/2016, de 16.11.2016/ Resolução 245/2015, de 17.12.2015/ Resolução 214/2017, de 20.12.2017/ Resolução 211/2022, de 06.12.2022.
    </div>

    <div style="font-size:10px;padding:3px;border-bottom: 1px solid #000;">
  Média Final por Disciplina: A nota alcançada em cada disciplina corresponde aos 3 anos do Ensino Médio.
       </div>
       <div style="font-size:10px;padding:3px;border-bottom: 1px solid #000;">
  Não há exigência de carga horária.
       </div>


    <div style="font-size:10px;padding:3px;border-bottom: 1px solid #000;">
  <b>
    Considera-se aprovado o estudante que obtiver Média Final igual ou superior a 5.0 (cinco) em cada disciplina.
  </b>
    </div>

    <div style="font-size:10px;padding:3px;border-bottom: 1px solid #000;">
  Regimento aprovado pelo CEE/AM.
       </div>

       <div style="font-size:10px;padding:3px;border-bottom: 1px solid #000;">
  Documentação Isenta de Autenticação conforme Artigo 70 da Resolução n° 99/97 - CEE/AM.
       </div>



    	<div style="margin-top:5px;text-align:right;padding:4px;margin-bottom:15px;"><?=data()?>.</div>

      <p>&nbsp;</p>
	<p>&nbsp;</p>
      <table class="">
    <tr>
    <td width="170"  ></th>
    <td width="350" style="border-top:1px #000 solid;text-align:center;font-size:12px">Secretário(a)
    </td>

    <td width="170"  ></th>

    <td width="350" style="border-top:1px #000 solid;text-align:center;font-size:12px">Diretor(a)
    </td>
    <td width="170"  ></th>
    </tr>


</table>


<!-- <p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p> -->


  <div style="border-bottom: 1px solid #000;padding:1px">
</div>


 <div style="font-size:12px;padding:5px;border-bottom: 1px solid #000;text-align:center">
 Fone: (55)(92) 3346-0191/ Whattsapp (55)(92) 99303-9416 - Manaus - Am - Brasil <br>
 e-mail:wm.supletivo@gmail.com - C.N.P.J.07.615.520/0003-10
       </div>


<!---final--->
</div>