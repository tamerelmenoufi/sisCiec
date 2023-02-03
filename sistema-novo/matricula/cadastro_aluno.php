<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");

if($_GET[codigo_curso]){
setcookie("cod_curso",$_GET[codigo_curso]);
setcookie("cod_disciplina",$_GET[codigo_disciplina]);
setcookie("cod_turma",$_GET[codigo_turma]);

//echo "<script>window.location.href='$PHP_SELF';</script>";

}

include("../includes/form_busca.inc.php");
include("../includes/estilos.inc.php");
//include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");



?>
<script language='javascript'>
   function monta_idioma(cam){
      //alert(cam);
      window.location.href=cam;
   }

</script>

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

if(isset($matricula)){
$query = "insert into matricula set
          codigo_escola = '$conf[codigo_curso]',
          codigo_curso = '$cod_curso',
					codigo_disciplina = '$cod_disciplina',
					codigo_turma = '$cod_turma',
					codigo_aluno = '$codigo_aluno',
					observacao = '$obs',
					data_exame = (select data_exame from turmas where codigo='$cod_turma')";
$result = mysql_query($query);	
$cod = mysql_insert_id();	
logs('matricula','insert',$cod,$query);			
echo "<script>alert('Marícula realizada com sucesso!');</script>";
echo "<script>window.close();</script>";
}

//novo
$query1  = " select ";
$query1 .= "cadastro_aluno.codigo,";
$query1 .= "cadastro_aluno.nome, ";
$query1 .= "cadastro_aluno.cpf, ";
$query1 .= "cadastro_aluno.rg, ";
$query1 .= "cadastro_aluno.telefone, ";
$query1 .= "cadastro_aluno.email";
$query1 .= " from cadastro_aluno";
$query1 .= " $complemento";

$result1 = mysql_query($query1);
$totreg = mysql_num_rows($result1);
$query = $query1." limit $param,$maxpag";
$result = mysql_query($query);
$totreg_01 = mysql_num_rows($result);


echo "<body leftmargin='0' topmargin='0' marginheight='0' marginwidth='0'>";


echo "<form action='$PHP_SELF' method='post'>";

echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "<tr><td height='332' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "      <tr><td colspan='6'  align='left'>
          <table border='0'  cellpadding='0' cellspacing='0' width='100%'>
            <tr><td width='18%' class='font_branca'>RG / CPF / NOME</td>
                <td width='90%'></td><tr><td colspan='2'  class='bg_busca_aluno' height='30'>
                  &nbsp;&nbsp;MATRÍCULA DE ALUNOS </td>
            <tr><td colspan='2'  class='bg_busca_aluno' height='50'>&nbsp;&nbsp;$formulario </td>

            <tr><td colspan='2'  class='bg_busca_aluno' height='50' align='right'>&nbsp;&nbsp;
                Idioma: <select name='obs' id='obs' class='form_select' style='width:150px' >
                   <option value='' id='opcoes'>:: Selecione ::
		   <option value=' Estrangeira Moderna: Ingl&ecirc;s'> Estrangeira Moderna: Ingl&ecirc;s
		   <option value=' Espanhola'> Espanhola
                </select>
                </td>


          </table>";
echo "</tr>";
echo "</table>";
if ($totreg){	
echo "<table width='100%'  border='0' cellpadding='0' cellspacing='0' class='borda_tabela'>";
echo "<td align='left' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr class='titulo_tabelas'>";
echo "<td>Nome";
echo "<td>CPF";
echo "<td>RG";
echo "<td>Telefone";
echo "<td>Email";
echo "<td width='35'>Ação";
echo "</tr>";
}
$cnt = 0;
while (list(
                 $codigo,
                 $nome,
                 $cpf,
                 $rg,
                 $telefone,
                 $email
                ) = mysql_fetch_row($result)){ $contador ++;
if($cnt%2 == 0){ echo "<tr class='tr_linha1'>"; }else{echo "<tr class='tr_linha2'>";}  $cnt++;
echo "<td class='titulo_f'>$nome";
echo "<td class='titulo_f'>$cpf";
echo "<td class='titulo_f'>$rg";
echo "<td class='titulo_f'>$telefone";
echo "<td class='titulo_f'>$email";
echo "<td width='35'><a href=\"javascript:monta_idioma('$PHP_SELF?matricula=matricula&codigo_aluno=$codigo&obs='+document.all.obs.value)\"><img src='../img/drafts.gif'  border='0' alt='Editar' width='15' height='16'></a>";
//echo "	<a href=\"javascript:confirma_delete($codigo,'$id');\">";
//echo "<img src='../img/trash.gif' alt='Excluir' border='0' width='16' height='16'></a></td>";
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
//include("../includes/rodape.inc.php");
echo "</form>";

echo "</body>";

?>
