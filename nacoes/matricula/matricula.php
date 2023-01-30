<?php
include("../includes/sessoes.inc.php");
include("../includes/form_busca.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");
include("../includes/connect.inc.php");
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

if($chave_busca){
$complemento = " where turmas.codigo like '%$chave_busca%' or cadastro_aluno.nome like '%$chave_busca%' or matricula.nota like '%$chave_busca%' or matricula.frequencia like '%$chave_busca%' or matricula.situacao like '%$chave_busca%'";
}else {$complemento = '';}
//fim da busca
if($op == 'excluir'){
$query  = " delete from matricula ";
$query .= " where codigo = '$cod'";
mysql_query($query);
logs('matricula','delete',$cod,$query);
echo "<script>window.location.href='matricula.php?id=$id'</script>";
 } 

//novo
$query1  = " select ";
$query1 .= "matricula.codigo,";
$query1 .= "turmas.codigo, ";
$query1 .= "cadastro_aluno.nome, ";
$query1 .= "matricula.nota, ";
$query1 .= "matricula.frequencia, ";
$query1 .= "matricula.situacao";
$query1 .= " from matricula";
$query1 .= " left join turmas on matricula.codigo_turma=turmas.codigo";
$query1 .= " left join cadastro_aluno on matricula.codigo_aluno=cadastro_aluno.codigo";
$query1 .= " $complemento";
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
echo "    <td colspan='5' class='titulos_modelos'>Matrícula";
echo "         <td  align='right'>$formulario";
echo "      <tr><td colspan='6'  align='right'> <a href='matricula_form.php?op=novo' class='paginacao'><img src='../img/new.gif' width='16' height='16' border='0'>";
echo "Novo Registro</a>";
echo "</table>";
if ($totreg){	
echo "<table width='100%'  border='0' cellpadding='0' cellspacing='0' class='borda_tabela'>";
echo "<td align='left' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr class='titulo_tabelas'>";
echo "<td>Turma";
echo "<td>Aluno";
echo "<td>Nota";
echo "<td>Frequência";
echo "<td>Situação";
echo "<td width='35'>Ação";
echo "</tr>";
}
$cnt = 0;
while (list(
                 $codigo,
                 $codigo_turma,
                 $codigo_aluno,
                 $nota,
                 $frequencia,
                 $situacao
                ) = mysql_fetch_row($result)){ $contador ++;
if($cnt%2 == 0){ echo "<tr class='tr_linha1'>"; }else{echo "<tr class='tr_linha2'>";}  $cnt++;
echo "<td class='titulo_f'>$codigo_turma";
echo "<td class='titulo_f'>$codigo_aluno";
echo "<td class='titulo_f'>$nota";
echo "<td class='titulo_f'>$frequencia";
if($situacao == 'AP'){ $situacao='aprovado';}
if($situacao == 'RP'){ $situacao='reprovado';}
echo "<td class='titulo_f'>$situacao";
echo "<td width='35'><a href=matricula_form.php?cod=$codigo&op=editar&id=$id><img src='../img/drafts.gif'  border='0' alt='Editar' width='15' height='16'></a>";
echo "	<a href=\"javascript:confirma_delete($codigo,'$id');\">";
echo "<img src='../img/trash.gif' alt='Excluir' border='0' width='16' height='16'></a></td>";
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
echo "      Mostrando de $reg_inicial a $reg_final de  $totreg";
      $texto=printf ;
echo "</td>";
echo "  </tr>";
echo "</table>";
include("../includes/rodape.inc.php");
echo "</form>";


?>
