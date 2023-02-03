<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");

include("../includes/estilos.inc.php");
?>
<style>
 td{
 	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
 }

</style>


<?php

include("../includes/estilos.inc.php");


include("../includes/topoDoc.php");


		   	$query = "select b.descricao as curso,
							 concat(c.descricao,' ',a.observacao) as disciplina,
							 concat(day(d.data_inicio),'/',month(d.data_inicio),'/',year(d.data_inicio),' a ',day(d.data_final),'/',month(d.data_final),'/',year(d.data_final),' ', d.turno) as turma,
							 e.nome as aluno,
							 a.situacao,
							 a.data
							 
							 from matricula a 
							 
							 left join cadastro_cursos b on a.codigo_curso = b.codigo
							 left join cadastro_disciplinas c on a.codigo_disciplina = c.codigo
							 left join turmas d on a.codigo_turma = d.codigo
							 left join cadastro_aluno e on a.codigo_aluno = e.codigo 
							 
							 where (a.data between '".data_formata($data1)." 00:00:00' and '".data_formata($data2)." 23:59:59') and a.codigo_escola='$conf[codigo_curso]' order by a.data";
			//echo $query;
			$result = mysql_query($query);
			if(mysql_num_rows($result)){
				echo "<table cellpadding='0' cellspacing='0' border='1' width='100%'>\n";
					echo "<tr><td>&nbsp;";
					echo "<td>Curso";
					echo "<td>Disciplina";
					echo "<td>Turma";
					echo "<td>Aluno";
					echo "<td>Situacao";
					echo "<td>Data";
				$i=0;
				while($d = mysql_fetch_object($result)){
					echo "<tr><td>&nbsp;".($i+1);
					echo "<td>&nbsp;".$d->curso;
					echo "<td>&nbsp;".$d->disciplina;
					echo "<td>&nbsp;".$d->turma;
					echo "<td>&nbsp;".$d->aluno;
					echo "<td>&nbsp;".$d->situacao;
					echo "<td>&nbsp;".data_formata($d->data);
				$i++;
				}
					echo "<tr><td colspan='7' align='right'>&nbsp;TOTAL DE ALUNOS: ".$i;
				echo " no per&iacute;odo de $data1 a $data2</table>";
			}
		   ?>
