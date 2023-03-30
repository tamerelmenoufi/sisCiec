<?php
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

	  //echo $segunda."<br>";
    //echo "<pre>";
    //print_r($_POST);
    //echo "</pre>";
    //exit();

     $n = count($_POST[codigo_curso]);
	 for($i=0;$i<$n;$i++){

         if($curso == $_POST[codigo_curso][$i]){

	   $query = "select codigo from certificados where codigo_aluno = '$cod' and codigo_curso='".$_POST[codigo_curso][$i]."'";
          // echo $i."<br>";
          // echo $query."<br>";
	   $result = mysql_query($query);
	     list($codigo,$l,$o) = mysql_fetch_row($result);
			$vt = $_POST[codigo_curso][$i];


             //echo "select * from certificados where livro='$livro[$vt]' and ordem='$ordem[$vt]' and  livro!='' and ordem!='' and codigo_aluno != '$cod'<br>";
             $t = mysql_num_rows(mysql_query("select * from certificados where livro='".$_POST[livro][$vt]."' and ordem='".$_POST[ordem][$vt]."' and  livro!='' and ordem!='' and codigo_aluno != '$cod'"));
          if($t){ $erro = 1; }
          else{
	     if(mysql_num_rows($result)){
		   $sql = "update certificados set unidade='".$_POST[unidade][$vt]."', livro='".$_POST[livro][$vt]."', folha='".$_POST[folha][$vt]."', data='".$_POST[data][$vt]."', ordem='".$_POST[ordem][$vt]."' , observacao='".$_POST[observacao][$vt]."' , complemento='".$_POST[complemento][$vt]."'  where codigo='$codigo'";
		   //echo $sql; exit;
		   mysql_query($sql);
		 }else{
		   $sql = "insert into certificados (codigo_curso,codigo_aluno,unidade,livro,folha,data,ordem,observacao,complemento) values ('$vt','$cod','".$_POST[unidade][$vt]."','".$_POST[livro][$vt]."','".$_POST[folha][$vt]."','".$_POST[data][$vt]."','".$_POST[ordem][$vt]."','".$_POST[observacao][$vt]."','".$_POST[complemento][$vt]."')";
		   mysql_query($sql);
		 }

	  }
          //echo "<br><br>POST:".$i.' - '.$_POST['segunda_via'][$vt]."<br>"; exit();

	  		if($_POST['segunda_via'][$vt]){
				$segundaVia = $_POST[segunda][$i];
				$segunda_via = $_POST['segunda_via'][$vt];
	  		}

        }
        }

    if($erro){
          echo "<script>alert('Operacao nao realizada, livro e ordem ja atribuidos a outros certificado!')</script>";
    }else{
          echo "<script>window.location.href='certificado.php?cod=$cod&curso=$curso&segunda_via=$segunda_via&fec=$fec&segunda=$segundaVia';</script>";

    }

  }

echo "<table width='100%' border='0' cellpadding='0' cellspacing='10'>";
echo "<tr><td height='332' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "  <tr>";
echo "    <td colspan='5' class='titulos_modelos'>Emitir Certificado";
echo "         <td  align='right'>&nbsp;";
echo "      <tr><td colspan='6'  align='left'><table border='0'  cellpadding='0' cellspacing='0' width='100%'>";
echo "<tr><td colspan='2'  class='bg_busca_aluno' height='30'><table border='0' cellpadding='10' width='100%' height='180' bgcolor='#DDDDDF'><tr><td valign='top'>";

//AQUI COME�A O PROGRAMA

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
		    $sql = "select codigo,livro,folha,data,ordem,observacao,complemento from certificados where codigo_aluno='$cod' and codigo_curso = '$dados->codigo'";
			$sql_r = mysql_query($sql);
			list($codigo,$livro,$folha,$data,$ordem,$observacao,$complemento) = mysql_fetch_row($sql_r);
		echo "Unidade: <select name='unidade[$dados->codigo]'>
                                  <option value='01'>Unidade 01</option>
                               </select> \n";
		echo "Livro: <input type='text' name='livro[$dados->codigo]' value='$livro' size='4'> \n";
		echo "Folha: <input type='text' name='folha[$dados->codigo]' value='$folha' size='4'> \n";
		echo "Data: <input type='text' name='data[$dados->codigo]' value='$data' size='11'> \n";
		echo "Ordem: <input type='text' name='ordem[$dados->codigo]' value='$ordem' size='5'> \n";
		echo "Complemento: <input type='text' name='complemento[$dados->codigo]' value='$complemento' size='25'> \n";
		echo "<br>Observa&ccedil;&atilde;o:<br><input type='text' name='observacao[$dados->codigo]' value='$observacao' style='width:100%'><br> \n";
		echo "<input type='hidden' name='codigo_curso[]' value='$dados->codigo'>\n";
		echo "<input type='hidden' name='codigo[$dados->codigo]' value='$codigo'>\n";
		echo "<input type='checkbox' name='segunda_via[$dados->codigo]' value='1'>Imprimir ";
		echo "<select name='segunda[]'>";
		for($i=2;$i<=10;$i++){
		echo "<option value='".$i."a. Via'>".$i."</option>";
		}
		echo "</select>";
		echo " &ordf; Via<br>\n";
		echo "<input type='checkbox' name='fec' value='1'>For&ccedil;ar a Emiss&atilde;o do Certificado\n";
		echo "</div>\n";
		  }

   echo "</form>";

// AQUI TERMINA
echo "</td></table>";
echo "</td></table>";
echo "</table>";
?>
