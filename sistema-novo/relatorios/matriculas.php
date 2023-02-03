<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");

include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../calendario/calendar1.js");


if(!$data1 and !$data2){
	$data1 = $data2 = date(d.'-'.m.'-'.Y);
}

?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="350" align="center" valign="top">
		<form action="<?=$PHP_SELF?>" method="post" name="f">
        <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
		 <tr>
		 <td colspan='3'class='titulos_modelos'>MATR&Iacute;CULAS
		 <tr>
		   <td align="center" valign="center">Data Inicial<br />
	       <input name="data1" type="text" id="data1" value="<?=$data1?>" maxlength="10" />
           <?php
		    echo "\n <a href='javascript:cal1.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
			echo "\n		\n<script language='JavaScript'>\n";
			echo "\n		<!-- \n";
			echo "\n			var cal1 = new calendar1(document.f.data1);\n";
			echo "\n			cal1.year_scrol1 = true;\n";
			echo "\n			//cal1.time_comp = true;\n";
			echo "\n		//-->\n";
			echo "\n		</script>\n";
		   ?>
	       (dd-mm-aaaa)
		   <td align="center" valign="center">Data Final<br />
	       <input name="data2" type="text" id="data2" value="<?=$data2?>" maxlength="10" />
           <?php
		    echo "\n <a href='javascript:cal2.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
			echo "\n		\n<script language='JavaScript'>\n";
			echo "\n		<!-- \n";
			echo "\n			var cal2 = new calendar1(document.f.data2);\n";
			echo "\n			cal2.year_scroll = true;\n";
			echo "\n			//cal2.time_comp = true;\n";
			echo "\n		//-->\n";
			echo "\n		</script>\n";
			
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
			
		   ?>
	       (dd-mm-aaaa)        
	       <td align="center" valign="center"><input type="submit" name="button" id="button" value="Submit" />           
		 <?php
		 	
			if(mysql_num_rows($result)){
		 ?>
         <tr>
		   <td colspan="3" align="center" valign="top"><input type="button" name="button2" id="button2" value="Vers&atilde;o para Impress&atilde;o" onclick="javascript:window.open('matriculas_print.php?data1=<?=$data1?>&data2=<?=$data2?>')" />         
	      <tr>
          <?php
		  	}
		  ?>
	       <td colspan="3" align="center" valign="top">
           <?php
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
     </table>
     </form>
	</td>
  </tr>
</table>
<br>
<?php

include("../includes/rodape.inc.php");

?>
