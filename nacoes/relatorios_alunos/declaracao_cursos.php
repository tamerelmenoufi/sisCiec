<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/estilos.inc.php");

?>

<script language="javascript">
   function validar(inf){
     if(!inf){
	   return false;
	 }
	return true;
   }
</script>


<style>

body {
	background-color: #F7F5F6;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

</STYLE> 

<?php

echo "<table width='100%' border='0' cellpadding='0' cellspacing='10'>";
echo "<tr><td height='332' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "  <tr>";
echo "    <td colspan='5' class='titulos_modelos'>Declaração de Conclusão";
echo "         <td  align='right'>&nbsp;";
echo "      <tr><td colspan='6'  align='left'><table border='0'  cellpadding='0' cellspacing='0' width='100%'>";
echo "<tr><td colspan='2'  class='bg_busca_aluno' height='30'><table border='0' cellpadding='10' width='100%' height='180' bgcolor='#DDDDDF'><tr><td valign='top'>";

//AQUI COMEÇA O PROGRAMA 


	$query = "select * from cadastro_cursos order by descricao";
	$result = mysql_query($query);
		echo "<form action='declaracao_conclusao.php' target='_blank' method='post' name='f'>\n";
		echo "<select name='d'>\n";
	    echo "<option value=''>:: Selecione o curso ::\n";
	while($dados = mysql_fetch_object($result)){
	    echo "<option value='$dados->codigo'>$dados->descricao ($dados->tipo)\n";
	}
		echo "</select>\n";
		echo "<input type='hidden' name='cod' value='$cod'>\n";
		echo "<input type='submit' name='sb' value='visualizar' onclick=\"return validar(document.all.f.curso.value)\">";
		
		
	$query = "select nome,rg from cadastro_aluno where codigo='$cod'";
	$result = mysql_query($query);
	//echo $query;
	list($nome,$rg) = mysql_fetch_row($result);

		echo "<br><br>Nome: <span class='campos_azul'>$nome</span><br>";
		echo "RG:  <span class='campos_azul'>$rg</span><br>";
        echo "<input type='checkbox' name='fec' value='1'>For&ccedil;ar a Emiss&atilde;o do Certificado\n<br>";
        echo "<textarea name='observacao' style='width:500px; height:150px;'></textarea>";
	
   echo "</form>";

// AQUI TERMINA 
echo "</td></table>";
echo "</td></table>";
echo "</table>";

?>