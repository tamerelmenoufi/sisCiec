<?php
include("../includes/sessoes.inc.php");
include("../includes/form_busca.inc.php");
include("../includes/estilos.inc.php");
$ferramentas = alunos;
include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");
include("../includes/connect.inc.php");
?>

<script language='javascript'>

   function imprimir_inscricao(arq,val){
      var w = window.open("./"+arq+"?cod=" + val,"alunoinscricao","width=600,height=200");
	  w.focus();
	  return false;
   }
   
   function imprimir_relatorio(url,cod,w,h){
	  var valor = '';
	  if(!cod){ alert('selecione um aluno !'); return false; }
	  if (url == 'declaracao_e_f.php' || url == 'declaracao_e_m.php' || url == 'declaracao_e_m_cursos.php' ){
	  	valor = prompt("Informe a data de termino");
	  	if (valor == null){ return false; }
	  }
	  //if(w == null || h == null){ var xw = ''; var xh = ''; }
	 // else{ var xw = 'width='+w;  var xh = ',height='+h; }
           var xw = ''; var xh = '';

         
	  var w = window.open("./"+url+"?cod=" + cod+ "&data="+valor+"&d="+w,url.replace(".",""),xw + xh);
	  w.focus();
	  return false;   
   }

	function aluno_selecionado(val){
	  document.all.opcao.value = val;
	}
  
  
</script>


<input type="hidden" name="opcao" value="">


<?php
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
$chave_busca = str_replace(" ","%%",$chave_busca);
$complemento = " where cadastro_aluno.nome like '%$chave_busca%' or cadastro_aluno.cpf = '$chave_busca' or cadastro_aluno.rg = '$chave_busca' ";
}else {$complemento = " where cadastro_aluno.nome = '' ";}
//fim da busca

//novo
$query1  = " select ";
$query1 .= "cadastro_aluno.cci,";
$query1 .= "cadastro_aluno.codigo,";
$query1 .= "cadastro_aluno.nome, ";
$query1 .= "cadastro_aluno.cpf, ";
$query1 .= "cadastro_aluno.rg, ";
$query1 .= "cadastro_aluno.telefone, ";
$query1 .= "cadastro_aluno.email";
$query1 .= " from cadastro_aluno ";
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
echo "    <td colspan='5' class='titulos_modelos'>Relat�rios de Alunos";
echo "         <td  align='right'>&nbsp;";
echo "      <tr><td colspan='6'  align='left'><table border='0'  cellpadding='0' cellspacing='0' width='100%'><tr><td width='18%' class='font_branca'>RG / CPF / NOME</td><td width='90%'></td><tr><td colspan='2'  class='bg_busca_aluno' height='50'>&nbsp;&nbsp;$formulario </td></table>";
echo "<tr><td colspan='6' class='paginacao' >";
if($chave_busca and !$totreg_01){
echo "<a href='cadastro_aluno_form.php?op=novo' class='paginacao'>N�o foram encontrados registros para os dados informados, para incluir como novo Clique aqui</a>";
}
echo "</tr>";
echo "</table>";
if ($totreg){	
echo "<table width='100%'  border='0' cellpadding='0' cellspacing='0' class='borda_tabela'>";
echo "<td align='left' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr class='titulo_tabelas'>";
echo "<td>CCI";
echo "<td>Nome";
echo "<td>CPF";
echo "<td>RG";
echo "<td>Telefone";
echo "<td>Email";
echo "<td width='100' align='center'>Selecionar";
echo "</tr>";
}
$cnt = 0;
while (list(
                 $cci,
				 $codigo,
                 $nome,
                 $cpf,
                 $rg,
                 $telefone,
                 $email
                ) = mysql_fetch_row($result)){ $contador ++;
if($cnt%2 == 0){ echo "<tr class='tr_linha1'>"; }else{echo "<tr class='tr_linha2'>";}  $cnt++;
echo "<td class='titulo_f'>$cci";
echo "<td class='titulo_f'>$nome";
echo "<td class='titulo_f'>$cpf";
echo "<td class='titulo_f'>$rg";
echo "<td class='titulo_f'>$telefone";
echo "<td class='titulo_f'>$email";
echo "<td width='120' align='center'>";

echo "<input type='radio' name='selecionado' value='$codigo' onclick=\"aluno_selecionado(this.value);\">";

/*
echo "<input type='image' src='../img/1.gif' title='Visualizar comprovante' onclick=\"return imprimir_inscricao('inscricao.php','$codigo');\">";
echo "<input type='image' src='../img/1.gif' title='Visualizar Declara��o' onclick=\"return imprimir_inscricao('comprovante.php','$codigo');\">";
echo " <input type='image' src='../img/2.gif' title='visualizar Hist�rico' onclick=\"return imprimir_relatorio('historico.php','$codigo');\">";
echo " <input type='image' src='../img/3.gif' title='Visualizar Declara��o de disciplinas' onclick=\"return imprimir_relatorio('disciplinas.php','$codigo');\">";
echo " <input type='image' src='../img/4.gif' title='Visualizar certificado' onclick=\"return imprimir_relatorio('certificado.php','$codigo');\">";
*/
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
			if ($reg_final < $results_tot) {echo "<a href='$arquivo?id=$pg_proxima' class='paginacao'><b>Pr�ximo >></b></font></a></td>"; }

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
