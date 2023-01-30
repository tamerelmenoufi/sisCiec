<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/estilos.inc.php");
?>
<STYLE TYPE="text/css"> 
<?php
  $query = "select * from cadastro_cursos order by descricao";
  $result = mysql_query($query);
  $i=0;
  while($dados = mysql_fetch_object($result)){
	 echo "#div_$dados->codigo {\n"; 
     echo "position:relative;\n";
	 echo "display:none;\n";
	 echo "    }\n\n";
  $i++;
  }
?>
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

var menus = new Array()
<?php
  $query = "select * from cadastro_cursos order by descricao";
  $result = mysql_query($query);
  $i=0;
  while($dados = mysql_fetch_object($result)){
    echo "menus[$i]='div_$dados->codigo'\n";
  $i++;
  }
?>

  function esconder(opc) { 

     eval("document.all"+"[\""+opc+"\"]"+".style.visibility"+"="+"\"hidden\""+";");
	 eval("document.all"+"[\""+opc+"\"]"+".style.display=\"none\";");

  } 
    function mostrar(opc) { 
        for(i=0;i<menus.length;i++){
		     esconder(menus[i]);
		}
     eval("document.all"+"[\""+opc+"\"]"+".style.visibility"+"="+"\"visible\""+";"); 
	 eval("document.all"+"[\""+opc+"\"]"+".style.display=\"block\";");

  } 
</SCRIPT>

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
  
	if($_POST[instituicao]){
	$_SESSION[cook_data_oficio] = data_formata($_POST[data_oficio]);
	$_SESSION[cook_pagina_oficio] = $_POST[pagina_oficio];
	$_SESSION[cook_instituicao] = $_POST[instituicao];
	$_SESSION[cook_departamento] = $_POST[departamento];
	$_SESSION[cook_responsavel] = $_POST[responsavel];
	$_SESSION[cook_cargo] = $_POST[cargo];
	$_SESSION[cook_observacoes] = $_POST[observacao];

		

     $n = count($codigo_curso);
	 for($i=0;$i<$n;$i++){

         if($curso == $codigo_curso[$i]){

	   $query = "select codigo from certificados where codigo_aluno = '$cod' and codigo_curso='$codigo_curso[$i]'";
          // echo $i."<br>";
          // echo $query."<br>";
	   $result = mysql_query($query);
	     list($codigo,$l,$o) = mysql_fetch_row($result);
			$vt = $codigo_curso[$i];


             //echo "select * from certificados where livro='$livro[$vt]' and ordem='$ordem[$vt]' and  livro!='' and ordem!='' and codigo_aluno != '$cod'<br>";
             $t = mysql_num_rows(mysql_query("select * from certificados where livro='$livro[$vt]' and ordem='$ordem[$vt]' and  livro!='' and ordem!='' and codigo_aluno != '$cod'"));
          if($t){ $erro = 1; }
          else{
	     if(mysql_num_rows($result)){
		   $sql = "update certificados set unidade='$unidade[$vt]', livro='$livro[$vt]', folha='$folha[$vt]', data='$data[$vt]', ordem='$ordem[$vt]' , observacao='$observacao[$vt]'  where codigo='$codigo'";
		   //echo $sql; exit;
		   // mysql_query($sql);
		 }else{
		   $sql = "insert into certificados (codigo_curso,codigo_aluno,unidade,livro,folha,data,ordem,observacao) values ('$vt','$cod','$unidade[$vt]','$livro[$vt]','$folha[$vt]','$data[$vt]','$ordem[$vt]','$observacao[$vt]')";
		   // mysql_query($sql);
		 } 

	  }
          //echo "ERRO:".$erro."<br>";
        }
        }

    if($erro){
          echo "<script>alert('Operacao nao realizada, livro e ordem ja atribuidos a outros certificado!')</script>";
    }else{
          echo "<script>window.location.href='oficio_autenticidade.php?cod=$cod&curso=$curso&segunda_via=$segunda_via&fec=$fec';</script>";

    }
	}else{
          echo "<script>alert('formulario incompleto, favor preencher os campos obrigatorios (*)!')</script>";
          echo "<script>window.close()</script>";
}
  }

echo "<table width='100%' border='0' cellpadding='0' cellspacing='10'>";
echo "<tr><td height='332' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "  <tr>";
echo "    <td colspan='5' class='titulos_modelos'>Emitir Of&iacute;cio";
echo "         <td  align='right'>&nbsp;";
echo "      <tr><td colspan='6'  align='left'><table border='0'  cellpadding='0' cellspacing='0' width='100%'>";
echo "<tr><td colspan='2'  class='bg_busca_aluno' height='30'><table border='0' cellpadding='10' width='100%' height='180' bgcolor='#DDDDDF'><tr><td valign='top'>";

//AQUI COMEÇA O PROGRAMA 

	$query = "select * from cadastro_cursos order by descricao";
	$result = mysql_query($query);
		echo "<form action='$PHP_SELF' target='_blank' method='post' name='f'>\n";
		echo "<select name='curso' onchange=\"mostrar('div_' + this.value);\">\n";
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
	
		  $query = "select * from cadastro_cursos order by descricao";
		  $result = mysql_query($query);
		  while($dados = mysql_fetch_object($result)){
		echo "<div id='div_$dados->codigo'>\n";
		echo " <span class='campos_azul'>$dados->descricao:</span><br>\n";
		    $sql = "select codigo,livro,folha,data,ordem,observacao from certificados where codigo_aluno='$cod' and codigo_curso = '$dados->codigo'";
			$sql_r = mysql_query($sql);
			list($codigo,$livro,$folha,$data,$ordem,$observacao) = mysql_fetch_row($sql_r);
		echo "Unidade: <select name='unidade[$dados->codigo]'>
                                  <option value='01'>Unidade 01</option>
                               </select> \n";
		echo "Livro: $livro &nbsp;&nbsp;&nbsp;\n";
		echo "Folha: $folha &nbsp;&nbsp;&nbsp;\n";
		echo "Data: $data &nbsp;&nbsp;&nbsp;\n";
		echo "Ordem: $ordem &nbsp;&nbsp;&nbsp;\n";

		echo "</div>\n";
		  }

		echo "<div>";
		
		echo "<br><br>Dados da publica&ccedil;&atilde;o do Di&aacute;rio:<br>Data: <input type='text' name='data_oficio' value='' style='width:100px'>&nbsp;&nbsp;P&aacute;gina:<input type='text' name='pagina_oficio' value='' style='width:50px'><br> \n";


		echo "<br>Dados do Destinat&aacute;rio:<br>
		<table><tr><td>Institui&ccedil;&atilde;o(*):</td><td><input type='text' name='instituicao' value='' style='width:300px'></td></tr>
		
		<tr><td>Departamento:</td>
		<td><input type='text' name='departamento' value='' style='width:300px'></td></tr>\n
		
		<tr><td>Respons&aacute;vel:</td><td><input type='text' name='responsavel' value='' style='width:300px'></td></tr>\n
		
		<tr><td>Cargo:</td><td><input type='text' name='cargo' value='' style='width:300px'></td></tr>

		<tr><td>Observações:</td><td><textarea name='observacao' style='width:500px; height:150px;'></textarea></td></tr>	

		</table>\n
		
		";

		echo "</div>";


   echo "</form>";

// AQUI TERMINA 
echo "</td></table>";
echo "</td></table>";
echo "</table>";
?>