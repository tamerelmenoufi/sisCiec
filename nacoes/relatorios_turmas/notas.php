<?php
@header("Content-Type: text/html; charset=iso-8859-1",true);
date_default_timezone_set('America/Manaus');
?>
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
font-family:Arial, Helvetica, sans-serif;
font-size:12px;
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

.arial13 {
font-family:Arial;
font-size:13px;
color:#000000;
font-weight:bold;
}

.arial10 {
font-family:Arial;
font-size:10px;
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
<form action="" method="post" name="f">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="640" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td ><table width="640"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
			
			<?php
			
			   include("../includes/connect.inc.php");
			   
			   
			   $query = "select b.descricao as disc,
			                    c.nome,
								d.descricao as curso,
								a.data_exame,
								a.turno
								from turmas a
								left join cadastro_disciplinas b on a.codigo_disciplina=b.codigo
								left join cadastro_professor c on a.codigo_professor=c.codigo
								left join cadastro_cursos d on a.codigo_curso=d.codigo
								where a.codigo='$cod' and c.nome!=''";
				$result = mysql_query($query);
				$dados = mysql_fetch_object($result);
			
			
			?>			
			
			<table width="640" cellpadding="0" cellspacing="0" class="borda_tabela">
              <tr>
                <td height="50" class="borda_tabela"><table width="640" height="19"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50" height="19">&nbsp;</td>
                    <td width="166"><img src="../img/logo_p.gif" width="150" height="50"></td>
                    <td height="60" class="arial16">&nbsp;E&nbsp;&nbsp;</td>
                    <td><img src="../img/logo_ciec.gif" width="185" height="52"></td>
                    <td width="312"><div align="center"><span class="arial20">Supletivo</span><br>
                              <span class="arial10"><?=$conf[resolucao]?></span></div></td>
                    <td width="20">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="borda_tabela"><table width="640"  border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr>
                    <td width="400" align="left" valign="top"><table width="400"  border="0" cellspacing="0" cellpadding="2" class="borda_tabela">
                      <tr>
                        <td class="borda_tabela"><div class="arial13">Disciplina:
                                <?=$dados->disc?>
                        </div></td>
                      </tr>
                    </table></td>
                    <td align="left" valign="bottom" class=""><div class="arial13">Data do exame: 
                      <?=data_formata($dados->data_exame)?>
                    </div></td>
                  </tr>
                  <tr>
                    <td width="400" align="left" valign="top"><table width="400"  border="0" cellspacing="0" cellpadding="2" class="borda_tabela">
                      <tr>
                        <td class="borda_tabela"><div class="arial13">Professor(a): 
                          <?=$dados->nome?>
                        </div></td>
                      </tr>
                    </table></td>
                    <td align="left" valign="bottom" class="arial13"><?=$dados->curso?>&nbsp;-&nbsp;<?=$dados->turno?></td>
                  </tr>
                </table>                  </td>
              </tr>
              <tr align="left" valign="top">
                <td align="center" class="borda_tabela"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td>
					 
					 
					 
					 <table width="640"  border="0" cellspacing="0" cellpadding="0" class="borda_tabela">
                      <tr>
                        <td width="27" class="borda_tabela"><div class="arial13">
                          <div align="center">N&ordm;</div>
                        </div></td>
                        <td width="60" class="borda_tabela"><div class="arial13">
                          <div align="center"><a href='<?=$PHP_SELF?>?ord=cci&cod=<?=$cod?>' class="arial13">CCI</a></div>
                        </div></td>
                        <td width="302" class="borda_tabela"><div class="arial13">
                          <div align="center"><a href='<?=$PHP_SELF?>?ord=aln&cod=<?=$cod?>' class="arial13">Nome</a></div>
                        </div></td>
                        <td width="60" class="borda_tabela"><div class="arial13">
                          <div align="center">Nota</div>
                        </div></td>
                        
                        <td width="96" class="borda_tabela"><div class="arial13">
                          <div align="center">Situa&ccedil;&atilde;o</div>
                        </div></td>
                      </tr>
                     <?php

					   if(!$ord){ $com = " order by b.cci "; }
					   elseif($ord == 'cci'){ $com = " order by b.cci "; }
					   elseif($ord == 'aln'){ $com = " order by b.nome "; }

					   
					   $query = "select a.codigo,a.codigo_aluno,b.cci,b.nome from matricula a left join cadastro_aluno b on a.codigo_aluno=b.codigo where a.codigo_turma='$cod' and b.nome!='' group by a.codigo_aluno $com";
					   $result = mysql_query($query);
					   $n = mysql_num_rows($result);
					   $i=1;
					   while($dados=mysql_fetch_object($result)){					 
					   
					   $sql = "select nota,frequencia,situacao from matricula where codigo='$dados->codigo'";
					   $sql_r = mysql_query($sql);
					   list($nota,$frequencia,$situacao) = mysql_fetch_row($sql_r);
					   
					 ?>
					  <tr>
                        <td width="27" align="center" class="borda_tabela">&nbsp;<?=$i?></td>
                        <td width="60" align="center" class="borda_tabela">&nbsp;<?=$dados->cci?></td>
                        <td width="302" class="borda_tabela">&nbsp;<?=strtoupper($dados->nome)?></td>
                        <td align="center" class="borda_tabela"><?=number_format($nota,1,".",".")?></td>
                        
                        <td width="96" align="center" class="borda_tabela">
                          <?php 
						       if($situacao == 'MT'){ echo 'matriculado'; }
						       if($situacao == 'AP'){ echo 'aprovado'; }
						       if($situacao == 'RP'){ echo 'reprovado'; }
						       if($situacao == 'FT'){ echo 'faltou'; }						    
						  ?>
						</td>
					  </tr>
                     <?php
					    $i++;
						}
				 ?>
                  </table>
                      </td>
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

</form>
</body>
</html>
