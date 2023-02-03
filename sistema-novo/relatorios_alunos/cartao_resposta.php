<?php

include("../includes/connect.inc.php");
include("../includes/data.inc.php");
include("../includes/data_ext.inc.php");

	$query = "select a.cci,a.nome,a.rg,a.rg_orgao,b.descricao,c.data_exame from cadastro_aluno a " 
		   . " left join matricula d on a.codigo = d.codigo_aluno "
		   . " left join cadastro_cursos b on d.codigo_curso = b.codigo "
		   . " left join turmas c on d.codigo_turma = c.codigo "
		   . " where d.codigo = '$cod' and a.nome!='' order by c.data_exame desc limit 0,1";
	$result = mysql_query($query);
	
	$dados = mysql_fetch_object($result);
	
?>
<style type="text/css">

.arial16 {
	font-family: arial;
	font-size: 16px;
	font-weight: none;
	text-decoration: none;
}

.arial12 {
	font-family: arial;
	font-size: 12px;
	font-weight: none;
	text-decoration: none;
}

.arial8 {
	font-family: arial;
	font-size: 8px;
	font-weight: none;
	text-decoration: none;
}

.arial20 {
	font-family: arial;
	font-size: 20px;
	font-weight: none;
	text-decoration: none;
}

.arial18 {
	font-family: arial;
	font-size: 18px;
	font-weight: none;
	text-decoration: none;
}

.arial25 {
	font-family: arial;
	font-size: 25px;
	font-weight: none;
	text-decoration: none;

}

.arial40 {
	font-family: arial;
	font-size: 40px;
	font-weight: none;
	text-decoration: none;
}

.arial26 {
	font-family: arial;
	font-size: 26px;
	font-weight: bold;
	text-decoration: none;
}

.borda1 {
border: solid 0px #000000;
background-image:url(../img/circulo_resposta.gif);
background-repeat:no-repeat;
}

.bordasemtop {
border-left: solid 1px #000000;
border-right: solid 1px #000000;
border-bottom: solid 1px #000000;
}

.bordaright {
	border-right: solid 1px #000000;
}
.style2 {font-family: arial; font-size: 8px; font-weight: bold; text-decoration: none; }
.arial121 {	font-family: arial;
	font-size: 14px;
	font-weight: none;
	text-decoration: none;
}
.borda11 {border: solid 0px #000000;
background-image:url(../img/circulo_resposta.gif);
background-repeat:no-repeat;
}
</style>
<html>
<head>
<title>CARTÃO RESPOSTA</title>
</head>

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
				where d.codigo='$cod' and f.codigo='$cod1'";
$sql_result = mysql_query($sql);

$dados = mysql_fetch_object($sql_result);

$len = strlen($dados->cod_mat);

for($i=$len;$i<11;$i++){
   $z = $z.'0';
}

$dados->cod_mat = $z.$dados->cod_mat;


?>

<body>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="700" height="44"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="350" height="500" align="left" valign="top"><table width="283" height="456"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="42"><img src="../img/logo_ciec.gif" width="133" height="37"></td>
            <td class="arial16">e</td>
            <td><div align="right"><img src="../img/logo_p.gif" width="130" height="42"></div></td>
          </tr>
          <tr>
            <td height="25" colspan="3" class="arial18"><div align="center"><strong>SUPLETIVO</strong></div></td>
          </tr>
          <tr>
            <td height="25" colspan="3"><div align="center"><span class="style2"><?=$conf[resolucao]?></span></div></td>
          </tr>
          <tr>
            <td height="15" colspan="3" class="arial12">CCI: 
              <?=$dados->cci?></td>
          </tr>
          <tr>
            <td height="15" colspan="3" class="arial12">Aluno:
              <?=$dados->nome_aluno?></td>
          </tr>
          <tr>
            <td height="15" colspan="3" class="arial12">RG: 
              <?=$dados->rg?></td>
          </tr>
          <tr>
            <td height="15" colspan="3" class="arial12">Disciplina: 
              <?=$dados->disc?></td>
          </tr>
          <tr>
            <td height="15" colspan="2" class="arial12">Data: 
              <?=data_formata($dados->data_exame)?></td>
            <td class="arial12"><?=$dados->disc_curso?></td>
          </tr>
          <tr>
            <td height="30" colspan="3" class="arial25"><div align="center">Cart&atilde;o Resposta </div></td>
          </tr>
          <tr>
            <td height="214" colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="10" >
              <tr>
                <td><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                  <tr class="arial121">
                    <td><div align="right">01</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">11</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">02</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">12</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">03</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">13</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">04</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">14</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">05</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">15</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">06</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">16</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">07</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">17</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">08</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">18</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">09</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">19</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                  <tr class="arial121">
                    <td><div align="right">10</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                    <td width="30">&nbsp;</td>
                    <td><div align="right">20</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">A</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">B</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">C</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">D</div></td>
                    <td width="20" height="20" align="center" valign="middle" class="borda11"><div align="center">E</div></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr valign="bottom">
            <td height="30" colspan="3" class="arial12">Assinatura: ........................................................................ </td>
          </tr>
          <tr>
            <td height="15" colspan="3" class="arial12">&nbsp;</td>
          </tr>
        </table></td>
        <td width="350" align="right" valign="top"><div align="right">
          </div></td>
      </tr>
      <tr>
        <td height="510" align="left" valign="bottom">&nbsp;</td>
        <td align="right" valign="bottom"><div align="right">
          </div></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
