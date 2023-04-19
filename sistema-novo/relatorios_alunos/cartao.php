<?php
include("../includes/connect.inc.php");
?>
<html>
<head>
<title> </title>

<script language="javascript">
   function imprime(){
      window.print();
   }
</script>

<style type="text/css">
<!--
body {
	background-image: url();
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
.borda_tabela {
border-bottom: solid 1px #000000;
border-top: solid 1px #000000;
border-left: solid 1px #000000;
border-right: solid 1px #000000;
}

.borda_tabela2 {
border-bottom: solid 1px #000000;
border-top: solid 1px #000000;
border-left: solid 1px #000000;
border-right: solid 1px #000000;
font-family:Arial, Helvetica, sans-serif;
font-size:11px;
text-align:center;
font-weight:bold;
}

.borda_baixo {
border-bottom: solid 1px #000000;
}

.borda_left {
border-left: solid 1px #000000;
}

.borda_right {
border-right: solid 1px #000000;
}

.arial20 {
font-family:Arial;
font-size:30px;
color:#000000;
font-weight:bold;
}

.arial12 {
font-family:Arial;
font-size:14px;
color:#000000;
font-weight:bold;
}

.arial21 {
font-family:Arial;
font-size:20px;
color:#000000;
font-weight:normal;
}

.arial11 {
font-family:Arial;
font-size:11px;
color:#000000;
font-weight:normal;
}

.arial16 {
font-family:Arial;
font-size:16px;
color:#000000;
font-weight:bold;
}

.arial14 {
font-family:Arial;
font-size:13px;
color:#000000;
font-weight:normal;
}

.style1 {
	font-size:11px;
	color:#000000;
	font-family: Arial;
	font-weight: bold;
}
.style3 {color:#000000; font-family: Arial; font-size: 11px;}
</style></head>

<body onLoad="imprime()">
<?php


$sql = "select a.*,
               f.cci,
			   b.nome,
			   f.codigo as cod_mat,
			   c.nota,
			   c.frequencia,
			   c.situacao,
			   concat(d.descricao,' ',c.observacao) as disc,
			   e.descricao as disc_curso,
			   f.nome as nome_aluno,
			   f.data_inscricao,
			   f.rg,
			   f.data_nascimento,
			   f.telefone
		from turmas a
        left join cadastro_professor b on a.codigo_professor = b.codigo
		left join matricula c on a.codigo_curso=c.codigo_curso and a.codigo_disciplina=c.codigo_disciplina and a.codigo=c.codigo_turma
		left join cadastro_disciplinas d on a.codigo_curso=d.codigo_curso and a.codigo_disciplina=d.codigo
		left join cadastro_cursos e on a.codigo_curso=e.codigo
		left join cadastro_aluno f on c.codigo_aluno=f.codigo
				where c.codigo='$cod'";
$sql_result = mysql_query($sql);

$dados = mysql_fetch_object($sql_result);

$len = strlen($dados->cod_mat);

for($i=$len;$i<11;$i++){
   $z = $z.'0';
}

//$dados->cod_mat = $z.$dados->cod_mat;


?>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="700" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="700" cellpadding="0" cellspacing="0" class="borda_tabela" style="background:url(../img/ciecbgcinza1.png) no-repeat  center;background-size:90%;">
              <tr>
                <td height="50" colspan="5" class="borda_tabela"><table width="700" height="19"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="50" height="19">&nbsp;</td>
                      <td width="166" align="center"><img src="../img/logo_pp.gif" /></td>
                      <td width="50" height="60"><div align="center" class="arial16">E</div></td>
                      <td width="100"><img src="../img/logo_ciec.gif" width="192" height="55"></td>
                      <td>
                        <div align="center">
                          <table border="0">
                            <tr class="arial16">
                              <td>Fone:</td>
                              <td><?=$Dicionario['cartao_fone']?> </td>
                            </tr>
                            <tr class="arial16">
                              <td>WhatsApp:</td>
                              <td><?=$Dicionario['cartao_whatsapp']?></td>
                            </tr>
                          </table>
                          <!-- <span class="arial16"> <br>
                          </span><span class="arial16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3346-0191</span><br>
                          <span class="arial16">&nbsp;&nbsp;Wpp: 99303-9416</span><br> -->
                        </div>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" class="borda_tabela"><p align="center" class="arial21">C.C.I. - Cart&atilde;o de Confirma&ccedil;&atilde;o de Inscri&ccedil;&atilde;o </p></td>
              </tr>
              <tr>
                <td height="32" class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Inscri&ccedil;&atilde;o</td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <?=$dados->cci?>
                      </td>
                    </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Data</td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <!--<?=data_formata($dados->data_inscricao)?>-->
                          <?=date(d.'-'.m.'-'.Y)?>
                      </td>
                    </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Documento de Identidade </td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <?=$dados->rg?>
                      </td>
                    </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Nascimento</td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <?=data_formata($dados->data_nascimento)?>
                      </td>
                    </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Telefone</td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <?=$dados->telefone?>
                      </td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="32" colspan="5" class="borda_tabela"><table width="700" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="14" class="arial11">&nbsp;&nbsp;Nome</td>
                    </tr>
                    <tr>
                      <td height="19" class="arial12">&nbsp;
                          <?=$dados->nome_aluno?>
                      </td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="100" colspan="5" valign="top" class="borda_tabela"><table width="700"  border="0" cellpadding="1" cellspacing="0">
                  <?php



$sqlm = "select a.*,
			   f.cci,
			   b.nome,
			   f.codigo as cod_mat,
			   c.nota,
			   c.frequencia,
			   c.situacao,
			   concat(d.descricao,' ',c.observacao) as disc,
			   e.descricao as disc_curso,
			   f.nome as nome_aluno,
			   f.data_inscricao,
			   f.rg,
			   f.data_nascimento,
			   f.telefone
		from turmas a
        left join cadastro_professor b on a.codigo_professor = b.codigo
		left join matricula c on a.codigo_curso=c.codigo_curso and a.codigo_disciplina=c.codigo_disciplina and a.codigo=c.codigo_turma
		left join cadastro_disciplinas d on a.codigo_curso=d.codigo_curso and a.codigo_disciplina=d.codigo
		left join cadastro_cursos e on a.codigo_curso=e.codigo
		left join cadastro_aluno f on c.codigo_aluno=f.codigo
				where c.codigo_aluno='$dados->cod_mat' and c.situacao='MT'";

			//echo $sqlm;
						  $sqlmr = mysql_query($sqlm);
						  if(mysql_num_rows($sqlmr)){
						  while($m = mysql_fetch_object($sqlmr)){
						  ?>
                  <tr>
                    <td width="764" height="19" class="arial16">&nbsp;
                        <?=$m->disc_curso?>
                    </td>
                  </tr>
                  <tr>
                    <td height="19" class="arial16"><span class="arial11">&nbsp;
                          <?=$m->disc?>
                      &nbsp; turno:
                      <?=$m->turno?>
                      &nbsp; per&iacute;odo de
                      <?=data_formata($m->data_inicio)?>
                      &nbsp;a&nbsp;
                      <?=data_formata($m->data_final)?>
                      &nbsp;hor&aacute;rio de
                      <?=$m->hora_inicio?>
                      &nbsp;as&nbsp;
                      <?=$m->hora_final?>
                      &nbsp;Exame
                      <?=data_formata($m->data_exame)?>
                    </span></td>
                  </tr>
                  <?php
						  }
						  }else{
						  ?>
                  <tr>
                    <td width="764" height="19" class="arial16">&nbsp;
                        <?=$dados->disc_curso?>
                    </td>
                  </tr>
                  <tr>
                    <td height="19" class="arial16"><span class="arial11">&nbsp;
                          <?=$dados->disc?>
                      &nbsp; turno:
                      <?=$dados->turno?>
                      &nbsp; per&iacute;odo de
                      <?=data_formata($dados->data_inicio)?>
                      &nbsp;a&nbsp;
                      <?=data_formata($dados->data_final)?>
                      &nbsp;hor&aacute;rio de
                      <?=$dados->hora_inicio?>
                      &nbsp;as&nbsp;
                      <?=$dados->hora_final?>
                      &nbsp;Exame
                      <?=data_formata($dados->data_exame)?>
                    </span></td>
                  </tr>
                  <?php
						  }
						  ?>
                </table></td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="5" class="borda_tabela"><table width="100%"  border="0" cellspacing="0" cellpadding="7">
                    <tr>
                      <td width="68%" class="borda_right" valign="top"><div align="justify" class="arial11" style="font-size:9px">
                          <span class="arial16">Instru&ccedil;&otilde;es: </span><span class="style1">IDADE M&Iacute;NIMA EXIGIDA - 15 anos Ens. Fund. / 18 anos Ens. M&eacute;dio</span><span class="arial16">.<br>
                            </span><strong>1</strong>. Comparecer ao local do exame na hora marcada. Ap&oacute;s esta s&oacute; com a autoriza&ccedil;&atilde;o pr&eacute;via.<br>
                            <strong>2</strong>. S&oacute; ser&atilde;o admitidos no recinto de exame os candidatos que estiverem munidos de <strong>DOCUMENTOS DE IDENTIDADE ORIGINAL</strong>. <strong><br>
                              3</strong>. Durante o exame &eacute; proibido o uso de aparelho celular. <strong><br>
                                4</strong>. Ser&aacute; automaticamente eliminado o candidato que deixar de comparecer ao exame. <strong><br>
                                  5</strong>. N&atilde;o informamos notas por telefone.<br>
                              I<strong>MPORTANTE</strong>: O candidato poder&aacute; solicitar revis&atilde;o de prova no prazo de 48 horas, a partir da divulga&ccedil;&atilde;o do resultado.<br>
                              O(a) Aluno(a) autoriza o envio de informa&ccedil;&otilde;es pela institui&ccedil;&atilde;o atrav&eacute;s de SMS?<br>
&nbsp;&nbsp;&nbsp;( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) Sim &nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) N&atilde;o&nbsp;<br>
                                <strong>N&Atilde;O &Eacute; PERMITIDA</strong>: <br>
                            - entrada na depend&ecirc;ncia da escola utilizando shorts, camiseta,chinelos, mini-blusa, bermudas e mini-saia.<br>
                            - a perman&ecirc;ncias de crian&ccedil;as, acompanhantes ou familiares em sala de aula.<br>
                            <br>
                            <b style="font-size:12px">Assinatura</b>: .................................................................................................................................... <br>
                        </div></td>
                      <td width="32%" align="left" valign="top" class="borda_left"><p class="arial11"><b>IMPORTANTE - LEIA</b><br>
  Para solicitar declara&ccedil;&otilde;es, atestado e certificado é necess&aacute;rio c&oacute;pia de:<br>
  a) Carteira de identidade, certid&atilde;o de nascimento, C.P.F. e comprovante de resid&ecirc;ncia.<br>
                                b) Taxa / prazo de entrega<br>
&nbsp;&nbsp;&nbsp;&nbsp;-Declara&ccedil;&otilde;es <?=$Dicionario['cartao_declaracao_taxa']?><br>
&nbsp;&nbsp;&nbsp;&nbsp;-Atestado de elimina&ccedil;&atilde;o <?=$Dicionario['cartao_atestado_taxa']?><br>
&nbsp;&nbsp;&nbsp;&nbsp;-Certificado <?=$Dicionario['cartao_certificado_taxa']?>.</p>

<p align='center' class="arial16">www.ciec-eja.com.br</p>

</td>
                    </tr>
                    <tr>
                      <td class="arial11">Local das provas - <?=$Dicionario['cartao_local_prova']?> <span class="arial14"> <br>
                      </span>OBS: <?=$Dicionario['cartao_obs_prova']?> </td>
                      <td class="arial12 borda_left">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>

          <tr>
            <td class="style3">&nbsp;</td>
          </tr>
          <tr>
            <td class="style3">.....................................................................................................................................................................................................................................................</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="700" style="" cellpadding="0" cellspacing="0" class="borda_tabela">
              <tr>
                <td height="50" colspan="5" class="borda_tabela"><table width="700" height="19"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="50" height="19">&nbsp;</td>
                      <td width="166" align="center"><img src="../img/logo_pp.gif" /></td>
                      <td width="50" height="60"><div align="center" class="arial16">E</div></td>
                      <td width="100"><img src="../img/logo_ciec.gif" width="192" height="55"></td>
                      <td>
                        <div align="center">
                        <table border="0">
                            <tr class="arial16">
                              <td>Fone:</td>
                              <td><?=$Dicionario['cartao_fone']?></td>
                            </tr>
                            <tr class="arial16">
                              <td>WhatsApp:</td>
                              <td><?=$Dicionario['cartao_whatsapp']?></td>
                            </tr>
                          </table>
                          <!-- </span><span class="arial16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3346-0191</span><br>
                          <span class="arial16">&nbsp;&nbsp;WhatsApp: 99303-9416</span><br> -->
                        </div>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" class="borda_tabela"><p align="center" class="arial21">C.C.I. - Cart&atilde;o de Confirma&ccedil;&atilde;o de Inscri&ccedil;&atilde;o </p></td>
              </tr>
              <tr>
                <td height="32" class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Inscri&ccedil;&atilde;o</td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <?=$dados->cci?>
                      </td>
                    </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Data</td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <!--<?=data_formata($dados->data_inscricao)?>-->
                          <?=date(d.'-'.m.'-'.Y)?>
                      </td>
                    </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Documento de Identidade </td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <?=$dados->rg?>
                      </td>
                    </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Nascimento</td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <?=data_formata($dados->data_nascimento)?>
                      </td>
                    </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="arial11">&nbsp;&nbsp;Telefone</td>
                    </tr>
                    <tr>
                      <td class="arial12">&nbsp;
                          <?=$dados->telefone?>
                      </td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="32" colspan="5" class="borda_tabela"><table width="700" height="33"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="14" class="arial11">&nbsp;&nbsp;Nome</td>
                    </tr>
                    <tr>
                      <td height="19" class="arial12">&nbsp;
                          <?=$dados->nome_aluno?>
                      </td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="100" colspan="5" valign="top" class="borda_tabela"><table width="700"  border="0" cellpadding="1" cellspacing="0">
                  <?php



$sqlm = "select a.*,
			   f.cci,
			   b.nome,
			   f.codigo as cod_mat,
			   c.nota,
			   c.frequencia,
			   c.situacao,
			   concat(d.descricao,' ',c.observacao) as disc,
			   e.descricao as disc_curso,
			   f.nome as nome_aluno,
			   f.data_inscricao,
			   f.rg,
			   f.data_nascimento,
			   f.telefone
		from turmas a
        left join cadastro_professor b on a.codigo_professor = b.codigo
		left join matricula c on a.codigo_curso=c.codigo_curso and a.codigo_disciplina=c.codigo_disciplina and a.codigo=c.codigo_turma
		left join cadastro_disciplinas d on a.codigo_curso=d.codigo_curso and a.codigo_disciplina=d.codigo
		left join cadastro_cursos e on a.codigo_curso=e.codigo
		left join cadastro_aluno f on c.codigo_aluno=f.codigo
				where c.codigo_aluno='$dados->cod_mat' and c.situacao='MT'";


						  $sqlmr = mysql_query($sqlm);
						  if(mysql_num_rows($sqlmr)){
						  while($m = mysql_fetch_object($sqlmr)){
						  ?>
                  <tr>
                    <td width="764" height="19" class="arial16">&nbsp;
                        <?=$m->disc_curso?>
                    </td>
                  </tr>
                  <tr>
                    <td height="19" class="arial16"><span class="arial11">&nbsp;
                          <?=$m->disc?>
                      &nbsp; turno:
                      <?=$m->turno?>
                      &nbsp; per&iacute;odo de
                      <?=data_formata($m->data_inicio)?>
                      &nbsp;a&nbsp;
                      <?=data_formata($m->data_final)?>
                      &nbsp;hor&aacute;rio de
                      <?=$m->hora_inicio?>
                      &nbsp;as&nbsp;
                      <?=$m->hora_final?>
                      &nbsp;Exame
                      <?=data_formata($m->data_exame)?>
                    </span></td>
                  </tr>
                  <?php
						  }
						  }else{
						  ?>
                  <tr>
                    <td width="764" height="19" class="arial16">&nbsp;
                        <?=$dados->disc_curso?>
                    </td>
                  </tr>
                  <tr>
                    <td height="19" class="arial16"><span class="arial11">&nbsp;
                          <?=$dados->disc?>
                      &nbsp; turno:
                      <?=$dados->turno?>
                      &nbsp; per&iacute;odo de
                      <?=data_formata($dados->data_inicio)?>
                      &nbsp;a&nbsp;
                      <?=data_formata($dados->data_final)?>
                      &nbsp;hor&aacute;rio de
                      <?=$dados->hora_inicio?>
                      &nbsp;as&nbsp;
                      <?=$dados->hora_final?>
                      &nbsp;Exame
                      <?=data_formata($dados->data_exame)?>
                    </span></td>
                  </tr>
                  <?php
						  }
						  ?>
                </table></td>
              </tr>
              <tr align="left" valign="top">
                <td colspan="5" class="borda_tabela"><table width="100%"  border="0" cellspacing="0" cellpadding="7">
                  <tr>
                    <td width="68%" class="borda_right" valign="top"><div align="justify" class="arial11" style="font-size:9px"> <span class="arial16">Instru&ccedil;&otilde;es: </span><span class="style1">IDADE M&Iacute;NIMA EXIGIDA - 15 anos Ens. Fund. / 18 anos Ens. M&eacute;dio</span><span class="arial16">.<br>
                        </span><strong>1</strong>. Comparecer ao local do exame na hora marcada. Ap&oacute;s esta s&oacute; com a autoriza&ccedil;&atilde;o pr&eacute;via.<br>
                        <strong>2</strong>. S&oacute; ser&atilde;o admitidos no recinto de exame os candidatos que estiverem munidos de <strong>DOCUMENTOS DE IDENTIDADE ORIGINAL</strong>. <strong><br>
                          3</strong>. Durante o exame &eacute; proibido o uso de aparelho celular. <strong><br>
                            4</strong>. Ser&aacute; automaticamente eliminado o candidato que deixar de comparecer ao exame. <strong><br>
                              5</strong>. N&atilde;o informamos notas por telefone.<br>
                      I<strong>MPORTANTE</strong>: O candidato poder&aacute; solicitar revis&atilde;o de prova no prazo de 48 horas, a partir da divulga&ccedil;&atilde;o do resultado.<br>
                      O(a) Aluno(a) autoriza o envio de informa&ccedil;&otilde;es pela institui&ccedil;&atilde;o atrav&eacute;s de SMS?<br>
                      &nbsp;&nbsp;&nbsp;( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) Sim &nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) N&atilde;o&nbsp;<br>
                      <strong>N&Atilde;O &Eacute; PERMITIDA</strong>: <br>
                      - entrada na depend&ecirc;ncia da escola utilizando shorts, camiseta,chinelos, mini-blusa, bermudas e mini-saia.<br>
                      - a perman&ecirc;ncias de crian&ccedil;as, acompanhantes ou familiares em sala de aula.<br>
                      <br>
                      <b style="font-size:12px">Assinatura</b>: .................................................................................................................... <br>
                    </div></td>
                    <td width="32%" align="left" valign="top" class="borda_left"><p class="arial11"><b>IMPORTANTE - LEIA</b><br>
                      Para solicitar declara&ccedil;&otilde;es, atestado e certificado é necess&aacute;rio c&oacute;pia de:<br>
                      a) Carteira de identidade, certid&atilde;o de nascimento, C.P.F. e comprovante de resid&ecirc;ncia.<br>
                      b) Taxa / prazo de entrega<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;-Declara&ccedil;&otilde;es R$ 15,00 - 10 dias &uacute;teis<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;-Atestado de elimina&ccedil;&atilde;o R$ 30,00 - 10 dias &uacute;teis<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;-Certificado R$ 50,00 - data estabelecida pela coordenação.</p>

<p align='center' class="arial16">www.ciec-eja.com.br</p>

</td>
                  </tr>
                  <tr>
                  <td class="arial11">Local das provas - <?=$Dicionario['cartao_local_prova']?> <span class="arial14"> <br>
                      </span>OBS: <?=$Dicionario['cartao_obs_prova']?> </td>
                      <td class="arial12 borda_left">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

