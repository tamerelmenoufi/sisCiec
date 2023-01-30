<html>
<head>
<title> </title>

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
.style2 {font-weight: bold}
.style3 {color:#000000; font-family: Arial; font-size: 11px;}
</style></head>

<body>
<?php

include("../includes/connect.inc.php");


$sql = "select a.*,
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

$dados->cod_mat = $z.$dados->cod_mat;


?>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="700" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="700" cellpadding="0" cellspacing="0" class="borda_tabela">
              <tr>
                <td height="50" colspan="5" class="borda_tabela"><table width="700" height="19"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50" height="19">&nbsp;</td>
                            <td width="166"><img src="logo_p.gif" width="150" height="50"></td>
                    <td width="166" height="60">&nbsp;</td>
                    <td width="100">&nbsp;</td>
                    <td width="232"><div align="center"><span class="arial20">SUPLETIVO</span><br>
                          <span class="arial12">Fone: 3236-4048 / 3642-5500 </span></div></td>
                    <td width="50">&nbsp;</td>
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
                            <td class="arial11"> &nbsp; 
                              <?=$dados->cod_mat?>
                            </td>
                  </tr>
                </table>                  </td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="arial11">&nbsp;&nbsp;Data</td>
                  </tr>
                  <tr>
                            <td class="arial11"> &nbsp; 
                              <?=data_formata($dados->data_inscricao)?>
                            </td>
                  </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="arial11">&nbsp;&nbsp;Documento de Identidade </td>
                  </tr>
                  <tr>
                            <td class="arial11"> &nbsp; 
                              <?=$dados->rg?>
                            </td>
                  </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="arial11">&nbsp;&nbsp;Nascimento</td>
                  </tr>
                  <tr>
                            <td class="arial11"> &nbsp; 
                              <?=data_formata($dados->data_nascimento)?>
                            </td>
                  </tr>
                </table></td>
                <td class="borda_tabela"><table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="arial11">&nbsp;&nbsp;Telefone</td>
                  </tr>
                  <tr>
                            <td class="arial11"> &nbsp; 
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
                            <td height="19" class="arial11"> &nbsp; 
                              <?=$dados->nome_aluno?>
                            </td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="57" colspan="5" class="borda_tabela">
                        <table width="700"  border="0" cellpadding="1" cellspacing="0">
                          <tr> 
                            <td width="764" height="19" class="arial16"> &nbsp; 
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
                        </table>
                      </td>
              </tr>
              <tr align="left" valign="top">
                <td height="100" colspan="5" class="borda_tabela"><table width="100%"  border="0" cellspacing="0" cellpadding="7">
                  <tr>
                    <td width="68%" class="borda_right"><div align="justify"><span class="arial16">Instru&ccedil;&otilde;es ao Candidato <br>
                      </span><span class="arial11"><strong>1</strong>. Comparecer ao local da prova com 30 minutos de anteced&ecirc;ncia. 
  &nbsp;&nbsp;&nbsp;<br>
  <strong>2</strong>. Nenhum candidato ter&aacute; acesso &agrave; sala de prova, ap&oacute;s a hora marcada para in&iacute;cio da mesma, salvo sob apresenta&ccedil;&atilde;o de autoriza&ccedil;&atilde;o pr&eacute;via. <strong><br>
  3</strong>. S&oacute; ser&atilde;o admitidos no recinto de prova os candidatos que estiverem munidos de documentos de identidade (original), com o qual se inscreveram, e tamb&eacute;m deste cart&atilde;o de confirma&ccedil;&atilde;o de inscri&ccedil;&atilde;o. <strong><br>
  4</strong>. Trazer l&aacute;pis, caneta preta e borracha. <strong><br>
  5</strong>. N&atilde;o &eacute; permitida a entrada de candidato no local de prova portando aparelho celular. 
    &nbsp;<br>
    <strong>6</strong>. ser&aacute; automaticamente eliminado o candidato que deixar de comparecer ao exame.&nbsp; 
    <strong><br>
    7</strong>. </span><span class="style1">AULAS: 2&ordf; &agrave; 6&ordf; 08:00 &agrave;s 09:30 15:00 &agrave;s 16:30 18:00 &agrave;s 19:30 &nbsp;REVIS&Atilde;O: 08:00 &agrave;s 09:30<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;09:30 &agrave;s 11:00 16:30 &agrave;s 18:00 19:30 &agrave;s 21:00&nbsp;&nbsp;&nbsp;&nbsp; S&aacute;bado 09:30 &agrave;s 11:00</span><br>
<br>
<span class="arial11"><strong>Assinatura</strong>: ......................................................................................................................... </span><br>

                      </div></td>
                    <td width="32%" align="left" valign="top" class="borda_left"><p><span class="arial16">IMPORTANTE - LEIA</span><br>
                          <span class="arial11">Para solicitar documentos, &eacute; necess&aacute;rio fotoc&oacute;pia de:<br>
                          a) Carteira de identidade<br>
                          b) Taxa de R$10,00 para qualquer documento da Educa&ccedil;&atilde;o de Jovens e Adultos<br>
                          c) Taxa de R$ 20,00 para expedi&ccedil;&atilde;o de Certificado</span><span class="arial14"><br>
                          </span><span class="arial12"><br>
                          Local de Provas</span><span class="arial14"><br>
                          </span><span class="arial11">Av. Djalma Batista, 1151 Chapada<br>
                          <strong>Obs: Resultado Oficial do exame somente 10 dias ap&oacute;s a prova.
                          </strong></span><span class="arial12"><br>
                          </span></p>                      </td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" class="arial12">A apresenta&ccedil;&atilde;o deste cart&atilde;o &eacute; obrigat&oacute;ria para a entrada na escola </td>
          </tr>
          <tr>
            <td><table width="700" border="0" cellspacing="0" cellpadding="0" class="borda_tabela2">
              <tr>
                <td height="30" class="borda_tabela2">01</td>
                <td class="borda_tabela2">02</td>
                <td class="borda_tabela2">03</td>
                <td class="borda_tabela2">04</td>
                <td class="borda_tabela2">05</td>
                <td class="borda_tabela2">06</td>
                <td class="borda_tabela2">07</td>
                <td class="borda_tabela2">08</td>
                <td class="borda_tabela2">09</td>
                <td class="borda_tabela2">10</td>
                <td class="borda_tabela2">11</td>
                <td class="borda_tabela2">12</td>
                <td class="borda_tabela2">13</td>
                <td class="borda_tabela2">14</td>
                <td class="borda_tabela2">15</td>
                <td class="borda_tabela2">16</td>
                <td class="borda_tabela2">17</td>
                <td class="borda_tabela2">18</td>
                <td class="borda_tabela2">19</td>
                <td class="borda_tabela2">20</td>
                <td class="borda_tabela2">21</td>
                <td class="borda_tabela2">22</td>
                <td class="borda_tabela2">23</td>
                <td class="borda_tabela2">24</td>
                <td class="borda_tabela2">25</td>
                <td class="borda_tabela2">26</td>
                <td class="borda_tabela2">27</td>
                <td class="borda_tabela2">28</td>
                <td class="borda_tabela2">29</td>
                <td class="borda_tabela2" >30</td>
                <td class="borda_tabela2">31</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="style3">...........................................................................................................................................................................................................................................</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
                  <table width="700" cellpadding="0" cellspacing="0" class="borda_tabela">
                    <tr> 
                      <td height="50" colspan="5" class="borda_tabela">
                        <table width="700" height="19"  border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="50" height="19">&nbsp;</td>
                            <td width="166"><img src="img/logo_p.gif" width="150" height="50"></td>
                            <td width="166" height="60">&nbsp;</td>
                            <td width="100">&nbsp;</td>
                            <td width="232">
                              <div align="center"><span class="arial20">SUPLETIVO</span><br>
                                <span class="arial12">Fone: 3236-4048 / 3642-5500 
                                </span></div>
                            </td>
                            <td width="50">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr> 
                      <td colspan="5" class="borda_tabela">
                        <p align="center" class="arial21">C.C.I. - Cart&atilde;o 
                          de Confirma&ccedil;&atilde;o de Inscri&ccedil;&atilde;o 
                        </p>
                      </td>
                    </tr>
                    <tr> 
                      <td height="32" class="borda_tabela">
                        <table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="arial11">&nbsp;&nbsp;Inscri&ccedil;&atilde;o</td>
                          </tr>
                          <tr> 
                            <td class="arial11"> &nbsp; 
                              <?=$dados->cod_mat?>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td class="borda_tabela">
                        <table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="arial11">&nbsp;&nbsp;Data</td>
                          </tr>
                          <tr> 
                            <td class="arial11"> &nbsp; 
                              <?=data_formata($dados->data_inscricao)?>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td class="borda_tabela">
                        <table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="arial11">&nbsp;&nbsp;Documento de Identidade 
                            </td>
                          </tr>
                          <tr> 
                            <td class="arial11"> &nbsp; 
                              <?=$dados->rg?>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td class="borda_tabela">
                        <table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="arial11">&nbsp;&nbsp;Nascimento</td>
                          </tr>
                          <tr> 
                            <td class="arial11"> &nbsp; 
                              <?=data_formata($dados->data_nascimento)?>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td class="borda_tabela">
                        <table width="100%" height="33"  border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td class="arial11">&nbsp;&nbsp;Telefone</td>
                          </tr>
                          <tr> 
                            <td class="arial11"> &nbsp; 
                              <?=$dados->telefone?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr> 
                      <td height="32" colspan="5" class="borda_tabela">
                        <table width="700" height="33"  border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="14" class="arial11">&nbsp;&nbsp;Nome</td>
                          </tr>
                          <tr> 
                            <td height="19" class="arial11"> &nbsp; 
                              <?=$dados->nome_aluno?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr> 
                      <td height="57" colspan="5" class="borda_tabela"> 
                        <table width="700"  border="0" cellpadding="1" cellspacing="0">
                          <tr> 
                            <td width="764" height="19" class="arial16"> &nbsp; 
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
                        </table>
                      </td>
                    </tr>
                    <tr align="left" valign="top"> 
                      <td height="100" colspan="5" class="borda_tabela">
                        <table width="100%"  border="0" cellspacing="0" cellpadding="7">
                          <tr> 
                            <td width="68%" class="borda_right">
                              <div align="justify"><span class="arial16">Instru&ccedil;&otilde;es 
                                ao Candidato <br>
                                </span><span class="arial11"><strong>1</strong>. 
                                Comparecer ao local da prova com 30 minutos de 
                                anteced&ecirc;ncia. &nbsp;&nbsp;&nbsp;<br>
                                <strong>2</strong>. Nenhum candidato ter&aacute; 
                                acesso &agrave; sala de prova, ap&oacute;s a hora 
                                marcada para in&iacute;cio da mesma, salvo sob 
                                apresenta&ccedil;&atilde;o de autoriza&ccedil;&atilde;o 
                                pr&eacute;via. <strong><br>
                                3</strong>. S&oacute; ser&atilde;o admitidos no 
                                recinto de prova os candidatos que estiverem munidos 
                                de documentos de identidade (original), com o 
                                qual se inscreveram, e tamb&eacute;m deste cart&atilde;o 
                                de confirma&ccedil;&atilde;o de inscri&ccedil;&atilde;o. 
                                <strong><br>
                                4</strong>. Trazer l&aacute;pis, caneta preta 
                                e borracha. <strong><br>
                                5</strong>. N&atilde;o &eacute; permitida a entrada 
                                de candidato no local de prova portando aparelho 
                                celular. &nbsp;<br>
                                <strong>6</strong>. ser&aacute; automaticamente 
                                eliminado o candidato que deixar de comparecer 
                                ao exame.&nbsp; <strong><br>
                                7</strong>. </span><span class="style1">AULAS: 
                                2&ordf; &agrave; 6&ordf; 08:00 &agrave;s 09:30 
                                15:00 &agrave;s 16:30 18:00 &agrave;s 19:30 &nbsp;REVIS&Atilde;O: 
                                08:00 &agrave;s 09:30<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;09:30 
                                &agrave;s 11:00 16:30 &agrave;s 18:00 19:30 &agrave;s 
                                21:00&nbsp;&nbsp;&nbsp;&nbsp; S&aacute;bado 09:30 
                                &agrave;s 11:00</span><br>
                                <br>
                                <span class="arial11"><strong>Assinatura</strong>: 
                                ......................................................................................................................... 
                                </span><br>
                              </div>
                            </td>
                            <td width="32%" align="left" valign="top" class="borda_left">
                              <p><span class="arial16">IMPORTANTE - LEIA</span><br>
                                <span class="arial11">Para solicitar documentos, 
                                &eacute; necess&aacute;rio fotoc&oacute;pia de:<br>
                                a) Carteira de identidade<br>
                                b) Taxa de R$10,00 para qualquer documento da 
                                Educa&ccedil;&atilde;o de Jovens e Adultos<br>
                                c) Taxa de R$ 20,00 para expedi&ccedil;&atilde;o 
                                de Certificado</span><span class="arial14"><br>
                                </span><span class="arial12"><br>
                                Local de Provas</span><span class="arial14"><br>
                                </span><span class="arial11">Av. Djalma Batista, 
                                1151 Chapada<br>
                                <strong>Obs: Resultado Oficial do exame somente 
                                10 dias ap&oacute;s a prova. </strong></span><span class="arial12"><br>
                                </span></p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
