<?php
include("../includes/connect.inc.php");

include("../includes/estilos.inc.php");
?>
<STYLE TYPE="text/css"> 
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
<script language="javascript">
   function validar(inf){
     if(!inf){
	   return false;
	 }
	return true;
   }
</script>

<?php


  if(isset($sb)){
  
     $n = count($codigo_aluno);
	 for($i=0;$i<$n;$i++){
	   $query = "select codigo from certificados where codigo_aluno = '$codigo_aluno[$i]' and codigo_curso='$codigo_curso'";
	   $result = mysql_query($query);
	     list($codigo) = mysql_fetch_row($result);
	     if(mysql_num_rows($result)){
		   $sql = "update certificados set livro='$livro[$i]', folha='$folha[$i]', data='".data_formata($data[$i])."' where codigo='$codigo'";
		   mysql_query($sql);
		 }else{
		   $sql = "insert into certificados (codigo_curso,codigo_aluno,livro,folha,data) values ('$codigo_curso','$codigo_aluno[$i]','$livro[$i]','$folha[$i]','".data_formata($data[$i])."')";
		   mysql_query($sql);
		 }

	 }

   echo "<script>window.location.href='certificado.php?cod=$cod';</script>";

  }

     $query = "select codigo_curso from turmas where codigo='$cod'";
	 $result = mysql_query($query);
	 list($curso) = mysql_fetch_row($result);
	 
	 
	 $query = "select a.codigo_curso,
	                  a.codigo_aluno,
					  b.descricao as curso,
					  c.nome as nome_aluno
					  from matricula a 
					  left join cadastro_cursos b on a.codigo_curso=b.codigo
					  left join cadastro_aluno c on a.codigo_aluno=c.codigo
					  where a.codigo_turma='$cod' and a.codigo_curso='$curso'";
	 $result = mysql_query($query);
	 $n_r = mysql_num_rows($result);
	 $k=0;
		
 
  	 while($dados = mysql_fetch_object($result)){
	 
	 if($k == 0){
	    
echo "<table width='100%' border='0' cellpadding='0' cellspacing='10'>";
echo "<tr><td height='332' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "  <tr>";
echo "    <td colspan='5' class='titulos_modelos'>Emitir Certificado";
echo "         <td  align='right'>&nbsp;";
echo "      <tr><td colspan='6'  align='left'><table border='0'  cellpadding='0' cellspacing='0' width='100%'>";
echo "<tr><td colspan='2'  class='bg_busca_aluno' height='30'><table border='0' cellpadding='10' width='100%' height='180' bgcolor='#DDDDDF'><tr><td valign='top'>";

//AQUI COMEÇA O PROGRAMA 
		
		
		echo "<form action='$PHP_SELF' method='post' name='g'>\n";
		echo "Livro: <input type='text' name='livro' value='$livro' size='4'> \n";
		echo "Folha: <input type='text' name='folha' value='$folha' size='4'> \n";
		echo "Data: <input type='text' name='data' value='".$data."' size='11'> \n";
		echo "<input type='submit' name='sub' value='atualizar'><br>";
		echo "<input type='hidden' name='cod' value='$cod'>\n";
		echo "</form>";
		
		echo "<form action='$PHP_SELF' target='_blank' method='post' name='f'>\n";
		echo "<input type='submit' name='sb' value='visualizar'><br><br>";
		echo "Curso: " . $dados->curso."<br>\n";
		echo '<div id="texto" align="justify" style="width:100%; height:90px; overflow: auto; padding:0px; background-color:#F0F0F0; font-size:12px; line-height:20px;">'."\n";
	 }
	 	  if(!isset($sub)){
		    $sql = "select codigo,livro,folha,data from certificados where codigo_aluno='$dados->codigo_aluno' and codigo_curso = '$curso'";
			$sql_r = mysql_query($sql);
			list($codigo,$livro,$folha,$data) = mysql_fetch_row($sql_r);
		  }else{
		    if($k == 0){ $data = data_formata($data); }
		  }
		echo "<br>Aluno(a): " . $dados->nome_aluno."<br>\n";
		echo "Livro: <input type='text' name='livro[]' value='$livro' size='4'> \n";
		echo "Folha: <input type='text' name='folha[]' value='$folha' size='4'> \n";
		echo "Data: <input type='text' name='data[]' value='".data_formata($data)."' size='11'> \n";
		echo "<input type='hidden' name='codigo_aluno[]' value='$dados->codigo_aluno'>\n";
		echo "<input type='hidden' name='codigo[]' value='$codigo'>\n<br>";
		 
		 $k++;
		  }
		  
		echo "<input type='hidden' name='codigo_curso' value='$curso'>\n";
		echo "<input type='hidden' name='cod' value='$cod'>\n";
   echo "</div>";
   echo "</form>";

// AQUI TERMINA 

echo "</td></table>";
echo "</td></table>";
echo "</table>";

if(!$n_r){
    include("mensagem_certificado_cursos.php");
}


?>

