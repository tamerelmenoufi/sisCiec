<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");

	$query = "select *, year(data_inicial) as ano from periodos where codigo='".$_POST[periodo]."'";
	//echo $query;
	$result = mysql_query($query);
	$d = mysql_fetch_object($result);

$filename = $d->descricao."_".$_GET[curso].".xls";
//header('Content-type: application/ms-excel');
//header('Content-Disposition: attachment; filename='.$filename);

include("../includes/estilos.inc.php");
//include("../includes/topo.inc.php");
//include("../calendario/calendar1.js");

function situacao($s){
   switch($s){
       case 'AP' : {
          return 'APROVADO';
          break;
       }
       case 'RP' : {
          return 'REPROVADO';
          break;
       }
       case 'FT' : {
          return 'FALTOU';
          break;
       }
  }

}

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
.corpo {
	font-family:Arial, Helvetica, sans-serif;
	font-size: 15px;
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

echo '<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="73"><img src="../img/logo_ciec.jpg" width="97" height="110"></td>
                  <td>
                    <div align="center"><span class="times18"><span class="style1">CENTRO INTEGRADO DE EDUCA&Ccedil;&Atilde;O CHRISTUS - CIEC </span><br>
              EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS - EJA </span><br>
              <span class="times12">Autorizado pela '.$_GET[r].' <br>
              Manaus-Amazonas </span></div></td>
                </tr>
              </table>';


echo "<h3>".$d->descricao." ( ".data_formata($d->data_inicial)." a ".data_formata($d->data_final)." ) "."</h3>";


echo "<p><table><tr><td colspan=9 height=50 align=left valign=top style='white-space:normal;'>Ata dos resultados finais do ".$d->descricao." Exame de Educação de Jovens e Adultos - EJA / ".$d->ano.", realizado no período de ".data_formata($d->data_inicial)." a ".data_formata($d->data_final).", nível de Ensino ".ucwords($_GET[curso]).", conforme prescreve a legislação em vigor.</table></p>";

	$query = "select b.descricao as escola, c.descricao as curso, d.descricao as disciplina, e.data_inicio, e.data_final, e.data_exame, e.turno, f.nome, f.rg, a.nota, a.frequencia, a.situacao, a.observacao from matricula a
	left join cadastro_escola b on a.codigo_escola = b.codigo
	left join cadastro_cursos c on a.codigo_curso = c.codigo
	left join cadastro_disciplinas d on a.codigo_disciplina = d.codigo
	left join turmas e on a.codigo_turma = e.codigo
	left join cadastro_aluno f on a.codigo_aluno = f.codigo where ((e.data_inicio between  '".$d->data_inicial."' and  '".$d->data_final."') or (e.data_final between  '".$d->data_inicial."' and  '".$d->data_final."')) and f.nome != '' and a.situacao != 'MT' and c.descricao='".(($_GET[curso] == 'fundamental') ? 'Ensino Fundamental' : 'Ensino Medio')."' and a.codigo_escola='".$conf[codigo_curso]."' order by f.nome, c.descricao, d.descricao";
	//echo $query;
	$result = mysql_query($query);

	echo "<table border='1' cellpadding='5' cellspacing='0'>\n";
		echo "<tr>\n";
		echo "<td><strong>ALUNO</strong>\n";
		echo "<td><strong>RG ALUNO</strong>\n";
		echo "<td><strong>ESCOLA</strong>\n";
		echo "<td><strong>CURSO</strong>\n";
		echo "<td><strong>DISCIPLINA</strong>\n";
		echo "<td><strong>TURNO</strong>\n";
		//echo "<td><strong>DATA INICIO DISC.</strong>\n";
		//echo "<td><strong>DATA FINAL DISC.</strong>\n";
		echo "<td><strong>DATA DO EXAME</strong>\n";
		echo "<td><strong>NOTA</strong>\n";
		//echo "<td><strong>FREQUENCIA</strong>\n";
		echo "<td><strong>RESULTADO</strong>\n";

	while($d = mysql_fetch_object($result)){
		echo "<tr>\n";
		echo "<td>&nbsp;".$d->nome."\n";
		echo "<td>&nbsp;".$d->rg."\n";
		echo "<td>&nbsp;".$d->escola."\n";
		echo "<td>&nbsp;".$d->curso."\n";
		echo "<td>&nbsp;".$d->disciplina.((trim($d->observacao)) ? ' ('.$d->observacao.')' : false)."\n";
		echo "<td>&nbsp;".$d->turno."\n";
		//echo "<td>&nbsp;".data_formata($d->data_inicio)."\n";
		//echo "<td>&nbsp;".data_formata($d->data_final)."\n";
		echo "<td>&nbsp;".data_formata($d->data_exame)."\n";
		echo "<td>&nbsp;".(($d->situacao == 'MT') ? false : number_format($d->nota,1,',',false))."\n";
		//echo "<td>&nbsp;".$d->frquencia."\n";
		echo "<td>&nbsp;".situacao($d->situacao)."\n";
	}

	echo "</table>\n";

   echo "<p><table border = 0 width=100%><tr><td colspan=9 align=left height=100 valign=top>E para constar, eu _______________________________________________________________ lavrei a presente ata que vai por mim assinada e pelo(a) diretor(a);<tr><td colspan=9 align=right height=100 valign=top><div align'right' valign=top>Manaus, ______ de ____________________ de _________.</div><tr><td colspan=4 align=center height=50 valign=top><div align'center'>_____________________________________________<br>SECRETÁRIO(A)</div><td align=center height=50 colspan=5 valign=top><div align'center'>_____________________________________________<br>DIRETOR(A)</div></table></p>";


?>