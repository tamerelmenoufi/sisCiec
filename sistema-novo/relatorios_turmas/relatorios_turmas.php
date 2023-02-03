<?php
include("../includes/sessoes.inc.php");
include("../includes/form_busca.inc.php");
$ferramentas = turmas;
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");

include("../includes/connect.inc.php");
include("../calendario/calendar1.js");

			function getmicrotime(){ 
			list($sec, $usec) = explode(" ",microtime()); 
			return ($sec + $usec); 
			} 
			$time_start = getmicrotime(); 

			$arquivo = "$PHP_SELF"; 
			$maxpag = 10;
			$maxlnk = 10;
			if ($id == ''){$param = 0;} else {
			$temp = $id;
			$passo1 = $temp - 1;
			$passo2 = $passo1*$maxpag;
			$param = $passo2;}
			
?>

<script language='javascript'>

   function imprimir_inscricao(arq,val){
      var w = window.open("./"+arq+"?cod=" + val,"alunoinscricao","width=600,height=200");
	  w.focus();
	  return false;
   }
   
   function imprimir_relatorio(url,cod,w,h){
	  if(!cod){ alert('selecione uma turma !'); return false; }
	  if(w == null || h == null){ var xw = ''; var xh = ''; }
	  else{ var xw = 'width='+w;  var xh = ',height='+h; }
	  var w = window.open("./"+url+"?cod=" + cod,"jga",xw + xh);
	  w.focus();
	  return false;   
   }

	function turma_selecionada(val){
	  document.all.opcao.value = val;
	}
  
  
</script>


<input type="hidden" name="opcao" value="">



<?php
if($chave_busca or $busca_curso or $busca_disciplina or $busca_data_inicio or $busca_data_final or $busca_turno){
	$complemento = " where 1 = 1 ";
        if($busca_professor){
	$chave_busca = str_replace(" ","%%",$busca_professor);
	$complemento .= " and cadastro_professor.nome like '%$busca_professor%' ";
        }
	if($busca_escola){
	$chave_busca = str_replace(" ","%%",$busca_escola);	
	$complemento .= " and cadastro_escola.descricao like '%$busca_escola%' ";
	}
	if($busca_curso){
	$chave_busca = str_replace(" ","%%",$busca_curso);	
	$complemento .= " and cadastro_cursos.descricao like '%$busca_curso%' ";
	}
	if($busca_disciplina){
	$chave_busca = str_replace(" ","%%",$busca_disciplina);
	$complemento .= " and cadastro_disciplinas.descricao like '%$busca_disciplina%' "; 
	}
	if($busca_data_inicio and !$busca_data_final){
	$complemento .= " and turmas.data_inicio = '".trim(data_formata($busca_data_inicio))."' ";
	} 
	if($busca_data_final and !$busca_data_inicio){
	$complemento .= " and turmas.data_final = '".trim(data_formata($busca_data_final))."' ";
	}
	if($busca_data_final and $busca_data_inicio){
	$complemento .= " and (turmas.data_inicio >= '".trim(data_formata($busca_data_inicio))."' and turmas.data_final <= '".trim(data_formata($busca_data_final))."') ";
	}
	if($busca_turno){
	$chave_busca = str_replace(" ","%%",$busca_turno);
	$complemento .= " and turmas.turno like '%$busca_turno%' ";
	}

}else {$complemento = " where turmas.data_inicio <= NOW() and turmas.data_final >= NOW() ";}
//fim da busca

//novo
$query1  = " select ";
$query1 .= "turmas.codigo,";
$query1 .= "cadastro_escola.descricao, ";
$query1 .= "turmas.codigo_curso, ";
$query1 .= "turmas.codigo_disciplina, ";
$query1 .= "cadastro_cursos.descricao, ";
$query1 .= "cadastro_disciplinas.descricao, ";
$query1 .= "cadastro_professor.nome, ";
$query1 .= "turmas.data_inicio, ";
$query1 .= "turmas.data_final, ";
$query1 .= "turmas.hora_inicio, ";
$query1 .= "turmas.hora_final, ";
$query1 .= "turmas.turno";
$query1 .= " from turmas";
$query1 .= " left join cadastro_escola on turmas.codigo_escola=cadastro_escola.codigo";
$query1 .= " left join cadastro_cursos on turmas.codigo_curso=cadastro_cursos.codigo";
$query1 .= " left join cadastro_disciplinas on turmas.codigo_disciplina=cadastro_disciplinas.codigo";
$query1 .= " left join cadastro_professor on turmas.codigo_professor=cadastro_professor.codigo";
$query1 .= " $complemento order by turmas.data_inicio desc,cadastro_cursos.descricao,cadastro_professor.nome,turmas.turno";
//echo $query1;
$result1 = mysql_query($query1);
$totreg = mysql_num_rows($result1);
$query = $query1." limit $param,$maxpag";
$result = mysql_query($query);
$totreg_01 = mysql_num_rows($result);
echo "<form action='$PHP_SELF' method='post'>";

echo "<table width='100%' border='0' cellpadding='0' cellspacing='10'>";
echo "<tr><td height='332' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "  <tr>";
echo "    <td colspan='6' class='titulos_modelos'>Relatórios de Turmas";

echo "      <tr><td colspan='7'  align='right'>";
echo "<table border='0'  cellpadding='0' cellspacing='0' width='100%'>";
echo "<tr><td width='40%' class='font_branca'>ESCOLA /CURSO / DISCIPLINA / TURNO</td>";
echo "<td width='90%'></td>";
echo "<tr><td colspan='2'  class='bg_busca_aluno' height='50'> &nbsp;&nbsp;";
echo "<input type='text' name='chave_escola' class='form_busca' value='$busca_escola'> / ";
echo "<input type='text' name='chave_curso' class='form_busca' value='$busca_curso'> / ";
echo "<input type='text' name='chave_disciplina' class='form_busca' value='$busca_disciplina'> / ";
echo "<input type='text' name='chave_turno' class='form_busca' value='$busca_turno'>";
echo "</td></table>";

echo "      <tr><td colspan='7'  align='right'>";
echo "<table border='0'  cellpadding='0' cellspacing='0' width='100%'>";
echo "<tr><td width='20%' class='font_branca'>DATA INÍCIO / FINAL</td><td width='90%'></td>";
echo "<tr><td colspan='2'  class='bg_busca_aluno' height='50'>&nbsp;&nbsp;";
echo "<input type='text' name='chave_data_inicio' class='form_busca' value='$busca_data_inicio'>";
echo " <a href='javascript:cal1.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a> / ";
echo "<input type='text' name='chave_data_final' class='form_busca' value='$busca_data_final'>";
echo " <a href='javascript:cal2.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
echo "</td></table>";

echo "		\n<script language='JavaScript'>\n";
echo "		<!-- \n";
echo "			var cal1 = new calendar1(document.all.chave_data_inicio);\n";
echo "			cal1.year_scroll = true;\n";
echo "			//cal1.time_comp = true;\n";

echo "			var cal2 = new calendar1(document.all.chave_data_final);\n";
echo "			cal2.year_scrol2 = true;\n";
echo "			//cal2.time_comp = true;\n";

echo "		//-->\n";
echo "		</script>\n";



echo "      <tr><td colspan='7'  align='right'><table border='0'  cellpadding='0' cellspacing='0' width='100%'><tr><td width='15%' class='font_branca'>PROFESSOR</td><td width='90%'></td><tr><td colspan='2'  class='bg_busca_aluno' height='50'>&nbsp;&nbsp;$formulario </td></table>";
//echo "<a href='turmas_form.php?op=novo' class='paginacao'><img src='../img/new.gif' width='16' height='16' border='0'>Nova Turma</a>";
echo "</table>";
if ($totreg){	
echo "<table width='100%'  border='0' cellpadding='0' cellspacing='0' class='borda_tabela'>";
echo "<td align='left' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr class='titulo_tabelas'>";
echo "<td>Escola";
echo "<td>Curso";
echo "<td>Disciplina";
echo "<td>Professor";
echo "<td>Data de Início";
echo "<td>Data Final";
echo "<td align='center'>Turno";
echo "<td width='15' align='center'>Selecionar";
echo "<td width='15' align='center'>&nbsp;";
echo "</tr>";
}
$cnt = 0;
while (list(
                 $codigo,
                 $codigo_escola,
                 $cod_curso,
                 $cod_disciplina,
                 $codigo_curso,
                 $codigo_disciplina,
                 $codigo_professor,
                 $data_inicio,
                 $data_final,
                 $hora_inicio,
                 $hora_final,
                 $turno
                ) = mysql_fetch_row($result)){ $contador ++;
if($cnt%2 == 0){ echo "<tr class='tr_linha1'>"; }else{echo "<tr class='tr_linha2'>";}  $cnt++;
echo "<td class='titulo_f'>$codigo_escola";
echo "<td class='titulo_f'>$codigo_curso";
echo "<td class='titulo_f'>$codigo_disciplina";
echo "<td class='titulo_f'>$codigo_professor";
echo "<td class='titulo_f'>".data_formata($data_inicio);
echo "<td class='titulo_f'>".data_formata($data_final);
if($turno == 'matutino'){ $turno='matutino <br>'.$hora_inicio.' <br> '.$hora_final;}
if($turno == 'vespertino'){ $turno='vespertino <br>'.$hora_inicio.' <br> '.$hora_final;}
if($turno == 'noturno'){ $turno='noturno <br>'.$hora_inicio.' <br> '.$hora_final;}
echo "<td class='titulo_f' align='center'>$turno";
echo "<td width='15' align='center'>";

echo "<input type='radio' name='selecionado' value='$codigo' onclick=\"turma_selecionada(this.value);\">";


/*
echo "<input type='image' src='../img/1.gif' title='Visualizar comprovante e ou Declaração' onclick=\"return imprimir_inscricao('$codigo');\">";
echo " <input type='image' src='../img/2.gif' title='visualizar Histórico' onclick=\"return imprimir_relatorio('historico.php','$codigo');\">";
echo " <input type='image' src='../img/3.gif' title='Visualizar Declaração de disciplinas' onclick=\"return imprimir_relatorio('disciplinas.php','$codigo','','');\">";
echo " <input type='image' src='../img/4.gif' title='Visualizar certificado' onclick=\"return imprimir_relatorio('certificado.php','$codigo','','');\">";
echo " <input type='image' src='../img/5.gif' title='Visualizar cartão resposta' onclick=\"return imprimir_relatorio('cartao_resposta.php','$codigo','','');\">";
echo " <input type='image' src='../img/6.gif' title='Visualizar pagela de freqüência' onclick=\"return imprimir_relatorio('pagela_frequencia.php','$codigo','','');\">";
echo " <input type='image' src='../img/7.gif' title='Visualizar pagela de notas' onclick=\"return imprimir_relatorio('pagela_notas.php','$codigo','','');\">";


*/

//matricula de aluno
echo " <td width='15'><input type='image' src='../img/2.gif' title='Matrícular alunos' onclick=\"window.open('../matricula/cadastro_aluno.php?codigo_curso=$cod_curso&codigo_disciplina=$cod_disciplina&codigo_turma=$codigo','ad','width=600,height=400');\">";


echo "</td>";
  } $reg_final = $param + $contador;
if ($totreg){	
echo "</table>";
echo "</td>";
echo "</table>";
 }
			$results_tot = $totreg;
			$results_parc = $totreg_01;
			$result_div = $results_tot/$maxpag;
			$n_inteiro = (int)$result_div;
			if ($n_inteiro < $result_div) {$n_paginas = $n_inteiro + 1;}
			else {$n_paginas = $result_div;}
			$pg_atual = $param/$maxpag+1;
			$reg_inicial = $param + 1;
			$pg_anterior = $pg_atual - 1;
			$pg_proxima = $pg_atual + 1;
			$time_end = getmicrotime(); 
			$time = $time_end - $time_start;
			echo "<tr><td height='10' valign='top'>";

echo "  <table border='0' cellspacing='0' align='center'>";
echo "    <tr>";
echo "      <td>";
			if ($id > 1) { echo "<a href='$arquivo?id=$pg_anterior' class='paginacao'><b><< anterior</font></a>"; }			if ($temp >= $maxlnk){
			if ($n_paginas > $maxlnk) {$n_maxlnk = $temp + 4;
			$maxlnk = $n_maxlnk;
			$n_start = $temp - 6;
			$lnk_impressos = $n_start;}}
			while(($lnk_impressos < $n_paginas) and ($lnk_impressos < $maxlnk))
			{ $lnk_impressos ++;

echo "      <center>";
echo "      <td>";
			if ($pg_atual != $lnk_impressos){echo "<a href=\"$arquivo?id=$lnk_impressos\" class=\"paginacao\">";}
			if ($pg_atual == $lnk_impressos){echo "<font class='pag_atual'>$lnk_impressos</font>";} else {echo "$lnk_impressos";}
echo "</a></b></font></td>";}

echo "	  </font></td>";
echo "      </center>";
echo "      <td>";
			if ($reg_final < $results_tot) {echo "<a href='$arquivo?id=$pg_proxima' class='paginacao'><b>Próximo >></b></font></a></td>"; }

echo "    </tr>";
echo "  </table>";
echo "  </table>";
echo "<table border='0' cellspacing='0' width='100%'>";
echo "  <tr>";
echo "    <td class='descricoes'>";
echo "      Mostrando $reg_inicial a $reg_final de  $totreg";
      $texto=printf ;
echo "</td>";
echo "  </tr>";
echo "</table>";
include("../includes/rodape.inc.php");
echo "</form>";


?>
