<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/connect.inc.php");
include("../calendario/calendar1.js");


    function check_disciplina($cod,$cur,$dis){
	  $query = "select * from professor_disciplina where codigo_curso='$cur' and codigo_disciplina='$dis' and codigo_professor='$cod'";
	  $query = mysql_query($query);
	  if(mysql_num_rows($query)){
	    return checked;
	  }else{
	    return false;
	  }
	}

?>
<script language='javascript'>
function validar(){

//validar campo nome
if(!document.all.f.nome.value){
alert('Campo nome obrigatorio!');
document.all.f.nome.focus();
return false;
}

//validar campo cpf
if(!document.all.f.cpf.value){
alert('Campo cpf obrigatorio!');
document.all.f.cpf.focus();
return false;
}

//validar campo rg
if(!document.all.f.rg.value){
alert('Campo rg obrigatorio!');
document.all.f.rg.focus();
return false;
}

//validar campo telefone
if(!document.all.f.telefone.value){
alert('Campo telefone obrigatorio!');
document.all.f.telefone.focus();
return false;
}
return true;
}
</script>

<?php

if($op == 'novo'){

$xdisabled = '';
$tit = 'Inserir ';

$botoes = "<input type='hidden' name='id' value='$id'>";
$botoes .= "<input type='submit' name='inserir' class='botao_alterar' value='Inserir' title='Inserir'  onclick='return validar();'>";
$botoes .= " <input type='submit' name='cancelar' class='botao_alterar' value='Cancelar' title='Cancelar' >";
}

if (isset($inserir)){
$query = " insert into cadastro_professor ( ";
$query .= " nome,";
$query .= " cpf,";
$query .= " rg,";
$query .= " telefone,";
$query .= " email";
$query .= " ) values (";
$query .= " '$nome',";
$query .= " '$cpf',";
$query .= " '$rg',";
$query .= " '$telefone',";
$query .= " '$email'";
$query .= " )";
$result = mysql_query($query);

$codigo = mysql_insert_id();
logs('cadastro_professor','insert',$codigo,$query);

$codigo = $conf[Unidade].$codigo;


for($i=0;$i<count($_POST[disciplina]);$i++){

  list($codigo_curso,$codigo_disciplina) = explode("|",$_POST[disciplina][$i]);

  $query  = "insert into professor_disciplina (codigo_curso,codigo_professor,codigo_disciplina)";
  $query .= " values ('$codigo_curso','$codigo','$codigo_disciplina')";
  mysql_query($query);
  $cod = mysql_insert_id();
  logs('professor_disciplina','insert',$cod,$query);

}



echo "<script>window.location.href='cadastro_professor_form.php?id=$id&op=editar&cod=$codigo'</script>";
}
elseif(isset($alterar)){
$query = " update cadastro_professor set";
$query .= " nome='$nome',";
$query .= " cpf='$cpf',";
$query .= " rg='$rg',";
$query .= " telefone='$telefone',";
$query .= " email='$email'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('cadastro_professor','update',$codigo,$query);

$query = "delete from professor_disciplina where codigo_professor='$codigo'";
mysql_query($query);

for($i=0;$i<count($_POST[disciplina]);$i++){

list($codigo_curso,$codigo_disciplina) = explode("|",$_POST[disciplina][$i]);

  $query  = "insert into professor_disciplina (codigo_curso,codigo_professor,codigo_disciplina)";
  $query .= " values ('$codigo_curso','$codigo','$codigo_disciplina')";
  //echo $query."<br>";
  mysql_query($query);
  logs('professor_disciplina','update',$codigo,$query);
}
 //exit();
//echo "<script>window.location.href='cadastro_professor_form.php?id=$id&op=editar&cod=$codigo'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='cadastro_professor.php?id=$id'</script>";
}


if($op == 'editar'){

  $xdisabled = 'disabled';
  $tit = 'Editar ';
  $query  = " select ";
  $query .= "cadastro_professor.codigo,";
  $query .= "cadastro_professor.nome, ";
  $query .= "cadastro_professor.cpf, ";
  $query .= "cadastro_professor.rg, ";
  $query .= "cadastro_professor.telefone, ";
  $query .= "cadastro_professor.email ";
  $query .= " from cadastro_professor where cadastro_professor.codigo='$cod'";
  $result = mysql_query($query);
  list(
                   $codigo,
                   $nome,
                   $cpf,
                   $rg,
                   $telefone,
                   $email
       ) = mysql_fetch_row($result);
  $botoes  = "<input type='hidden' name='codigo' value='$codigo'>";
  $botoes .= "<input type='hidden' name='id' value='$id'>";
  $botoes .= "<input type='submit' name='alterar' class='botao_alterar' value='Alterar' title='Alterar'  onclick='return validar();'>";
  $botoes .= " <input type='submit' name='cancelar' class='botao_alterar' value='Cancelar' title='Cancelar' >";
  }
  
echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='f' id='f'>";
echo "<table width='100%' cellspacing='10' cellpadding='0'>";
echo "<tr><td avlign='top'>";
echo "              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "                <tr> ";
echo "                  <td colspan='2' class='titulos_modelos'>$tit Professores";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Nome:<td>";
echo "<input type='text' name='nome' id='nome' value='$nome' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "CPF:<td>";
echo "<input type='text' name='cpf' id='cpf' value='$cpf' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "RG:<td>";
echo "<input type='text' name='rg' id='rg' value='$rg' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Telefone:<td>";
echo "<input type='text' name='telefone' id='telefone' value='$telefone' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Email:<td>";
echo "<input type='text' name='email' id='email' value='$email' size='' maxlength='' class='form_text'>";

echo "<tr class='bg_form'><td colspan='2' align='left'>";


$query = "select * from cadastro_cursos order by descricao";
$result = mysql_query($query);
echo "<table>";
while($dados_curso = mysql_fetch_object($result)){
   echo "<tr><td colspan='10'><b>".$dados_curso->descricao." (".$dados_curso->tipo.")"."</b>";
	$query1 = "select * from cadastro_disciplinas where codigo_curso='$dados_curso->codigo' order by descricao";
	$result1 = mysql_query($query1);
	  $i=0;
	while($dados_disciplina = mysql_fetch_object($result1)){
	   if($i%5 == 0){ echo "<tr>"; }
		echo "<td><input type='checkbox' name='disciplina[]' value='$dados_curso->codigo".'|'."$dados_disciplina->codigo' ".check_disciplina($codigo,$dados_curso->codigo,$dados_disciplina->codigo).">";
		echo '<td>'.$dados_disciplina->descricao."<br>";
	$i++;
	}
}
echo "</table>";



echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "              </table>";
echo "     </table>";





echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
?>
