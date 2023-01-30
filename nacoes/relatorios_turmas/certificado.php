<?php

include("../includes/connect.inc.php");
include("../includes/data.inc.php");
include("../includes/data_ext.inc.php");

?>

<style type="text/css">
<!--
.times18 {
	font-family: "Times New Roman", Times, serif;
	font-size: 30px;
	font-weight: none;
	text-decoration: none;
}

.times12 {
	font-family: "Times New Roman", Times, serif;
	font-size: 18px;
	font-weight: none;
	text-decoration: none;
}
.dauphin {
	font-family:Dauphin;
	font-size: 90px;
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
.style3 {font-family: "Times New Roman", Times, serif; font-size: 18px; font-weight: bold; text-decoration: none; }
-->
</style>

<?php

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

$cod_mensagem = $cod;

$sql = "select codigo_aluno,codigo_curso from matricula where codigo_turma='$cod'";
$sql_r = mysql_query($sql);
$numero_de_paginas = mysql_num_rows($sql_r);
$i=0;
while(list($cod,$curso) = mysql_fetch_row($sql_r)){


   $query = "select codigo from cadastro_disciplinas where codigo_curso='$curso'";
   $result = mysql_query($query);
   while($dados = mysql_fetch_object($result)){
	  if(!verifica_certificacao($dados->codigo,$cod,$curso)){
	    $retorno = true;
	  }
   }

   if(!$retorno){
	
	$query = "select a.nome,a.rg,a.rg_orgao,a.data_nascimento,a.cidade,a.estado,b.descricao,c.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where a.codigo = '$cod' and d.codigo_curso='$curso' order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);
	$dados = mysql_fetch_object($result);
	$numero_paginas = mysql_num_rows($result);

?>

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
        <td><table width="900"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="73"><img src="../img/logo_ciec.jpg" width="97" height="110"></td>
                  <td>
                    <div align="center"><span class="times18"><span class="style1">CENTRO INTEGRADO DE EDUCA&Ccedil;&Atilde;O CHRISTUS - CIEC </span><br>
              EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS – EJA </span><br>
              <span class="times12">Autorizado pela <?=$conf[resolucao]?> <br>
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
            <td class="dauphin16" style="white-space:normal"> Certificamos que 
              <?=$dados->nome?>, natural de 
              <?=$dados->cidade?>
              , Unidade Federada 
              <?=$dados->estado?>
              , portador(a) da Carteira de Identidade n&ordm; <?=$dados->rg?>
              , &Oacute;rg&atilde;o Expedidor 
              <?=$dados->rg_orgao?>
              , nascido(a) no dia 
              <?=data_ext($dados->data_nascimento)?>
              , tendo em vista os <span class="dauphin16" style="white-space:normal">
              <?=$dados->descricao?>
              </span>resultados obtidos no Exame Supletivo realizado em 
              <?=data_ext($dados->data_exame)?>
              , concluiu o 
              
              , conforme prescreve a legisla&ccedil;&atilde;o em vigor.</td>
          </tr>
          <tr>
            <td class="dauphin16">&nbsp; </td>
          </tr>
          <tr>
            <td align="right" class="dauphin16"><div align="right"><?=data()?>.</div></td>
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
            </table></td>
          </tr>
        </table></td>
        <td><img src="../img/canto7_borda_certificado.gif" width="29" height="610"></td>
      </tr>
      <tr>
        <td width="20"><img src="../img/canto4_borda_certificado.gif" width="29" height="29"></td>
        <td background="../img/canto6_borda_certificado.gif"><img src="../img/canto6_borda_certificado.gif" width="100%" height="29"></td>
        <td width="20"><img src="../img/canto3_borda_certificado.gif" width="29" height="29"></td>
      </tr>
    </table>
    
	<?php //aqui entra a quebra de página ?>
	<p><center style="page-break-after: always;"></center></p>

    <table width="100%"  cellspacing="0" cellpadding="0" class="borda1">
	  <tr>
        <td height="35" colspan="4" align="center" valign="top" class="times12"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="73">&nbsp;</td>
              <td align="left"><div align="center"><span class="times12"><img src="../img/logo_ciec.jpg" width="45" align="left" />CENTRO INTEGRADO DE EDUCA&Ccedil;&Atilde;O CHRISTUS - CIEC <br />
                EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS &ndash; EJA </span><br />
                Autorizado pela
                <?=$conf[resolucao]?>
              </div></td>
            </tr>
        </table></td>
	    </tr>
	  <tr>
        <td height="35" colspan="4" align="center" valign="top" class="times12">&nbsp;</td>
	    </tr>
	
      <tr>
        <td height="35" class="times12">Disciplinas</td>
        <td align="center"><strong>Data</strong></td>
        <td align="center" class="times12">Escola</td>
        <td align="center"><strong>Nota</strong></td>
      </tr>
	<?php
	
	
	     //$query = "select codigo,descricao from cadastro_disciplinas where codigo_curso='$curso'";
		 //$result = mysql_query($query);
		 //while($dados = mysql_fetch_object($result)){
		 
		 	$sql1 = " select a.data_exame,a.nota,c.descricao,d.descricao from matricula a "
			      ." left join turmas b on a.codigo_turma=b.codigo "
				  ." left join cadastro_escola c on c.codigo=a.codigo_escola "
				  ." left join cadastro_disciplinas d on a.codigo_disciplina=d.codigo "
				  ." where  a.situacao='AP' and a.codigo_aluno='$cod' and a.codigo_curso='$curso' order by d.ordem";
			$sql_r1 = mysql_query($sql1);
			while(list($data_exame,$nota,$escola,$disciplina)=mysql_fetch_row($sql_r1)){
	?>
      <tr>
        <td width="419" height="35" class="times12"><?=$disciplina?> </td>
        <td width="104"><div align="center" class="times12"><?=data_formata($data_exame)?></div></td>
        <td width="413" class="times12"><?=$escola?> </td>
        <td width="72"><div align="center" class="times12"><?=number_format($nota,1,',',false)?></div></td>
      </tr>
	<?php
		}
	?>
    </table>    
    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="403" height="150">&nbsp;</td>
        <td>&nbsp;</td>
        <td><div align="center">
            <table width="320" height="70"  border="0" cellpadding="0" cellspacing="0">
              <tr >
			  
			  <?php
			     $query1 = "select livro,folha,data from certificados where codigo_curso='$curso' and codigo_aluno='$cod'";
				 $result1 = mysql_query($query1);
				 list($livro,$folha,$data) = mysql_fetch_row($result1);			  
			  ?>
			  
                <td height="33%" class="borda2"><div align="center"><span class="style3">CERTIFICADO REGISTRADO NO <br>
                LIVRO <?=$livro?> fOLHA N&ordm; <?=$folha?><br>
                EM <?=data_formata($data)?> </span><br>
                </div></td>
              </tr>
            </table>
        </div></td>
      </tr>
    </table>    
    <p>&nbsp;</p></td>
  </tr>
</table>

<?php

 if(($i < ($numero_de_paginas -1))){
	 echo "\n\n"."<center style=\"page-break-after: always;\"></center>"."\n\n";
 }
 }
 $i++;  }
 
 if(!$numero_paginas){
    include("mensagem_certificado.php");
 }
 
 
?>
