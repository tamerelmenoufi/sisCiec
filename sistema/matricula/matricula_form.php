<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/connect.inc.php");
include("../calendario/calendar1.js");
?>
<script language='javascript'>
function validar(){

//validar campo codigo_turma
if(!document.all.f.codigo_turma.value){
alert('Campo codigo_turma é obrigatório!');
document.all.f.codigo_turma.focus();
return false;
}

//validar campo codigo_aluno
if(!document.all.f.codigo_aluno.value){
alert('Campo codigo_aluno é obrigatório!');
document.all.f.codigo_aluno.focus();
return false;
}
return true;
}
</script>

<?php
if($op == 'editar'){

$xdisabled = 'disabled';
$tit = 'Editar ';
$query  = " select ";
$query .= "matricula.codigo,";
$query .= "matricula.codigo_turma, ";
$query .= "matricula.codigo_aluno, ";
$query .= "matricula.nota, ";
$query .= "matricula.frequencia, ";
$query .= "matricula.situacao ";
$query .= " from matricula where matricula.codigo='$cod'";
$result = mysql_query($query);
list(
                 $codigo,
                 $codigo_turma,
                 $codigo_aluno,
                 $nota,
                 $frequencia,
                 $situacao
		 ) = mysql_fetch_row($result);
$botoes  = "<input type='hidden' name='codigo' value='$codigo'>";
$botoes .= "<input type='hidden' name='id' value='$id'>";
$botoes .= "<input type='submit' name='alterar' class='botao_alterar' value='Alterar' title='Alterar'  onclick='return validar();'>";
$botoes .= " <input type='submit' name='cancelar' class='botao_alterar' value='Cancelar' title='Cancelar' >";
}

elseif($op == 'novo'){

$xdisabled = '';
$tit = 'Inserir ';

$botoes = "<input type='hidden' name='id' value='$id'>";
$botoes .= "<input type='submit' name='inserir' class='botao_alterar' value='Inserir' title='Inserir'  onclick='return validar();'>";
$botoes .= " <input type='submit' name='cancelar' class='botao_alterar' value='Cancelar' title='Cancelar' >";
}

if (isset($inserir)){
$query = " insert into matricula ( ";
$query .= " codigo_turma,";
$query .= " codigo_aluno,";
$query .= " nota,";
$query .= " frequencia,";
$query .= " situacao";
$query .= " ) values (";
$query .= " '$codigo_turma',";
$query .= " '$codigo_aluno',";
$query .= " '$nota',";
$query .= " '$frequencia',";
$query .= " '$situacao'";
$query .= " )";
$result = mysql_query($query);
$cod = mysql_insert_id();
logs('matricula','insert',$cod,$query);

echo "<script>window.location.href='matricula.php?id=$id'</script>";
}
elseif(isset($alterar)){
$query = " update matricula set";
$query .= " codigo_turma='$codigo_turma',";
$query .= " codigo_aluno='$codigo_aluno',";
$query .= " nota='$nota',";
$query .= " frequencia='$frequencia',";
$query .= " situacao='$situacao'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('matricula','update',$codigo,$query);
echo "<script>window.location.href='matricula.php?id=$id'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='matricula.php?id=$id'</script>";
}
echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='f' id='f'>";
echo "<table width='100%' cellspacing='10' cellpadding='0'>";
echo "<tr><td avlign='top'>";
echo "              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "                <tr> ";
echo "                  <td colspan='2' class='titulos_modelos'>$tit Matrícula";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Turma:<td>";
$sql = "select codigo,codigo from turmas";
$sql_result = mysql_query($sql);
echo "<select name='codigo_turma' id='codigo_turma' class='form_select'>";
echo "<option value=''>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_turma){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' $selected>$b";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Aluno:<td>";
$sql = "select codigo,nome from cadastro_aluno";
$sql_result = mysql_query($sql);
echo "<select name='codigo_aluno' id='codigo_aluno' class='form_select'>";
echo "<option value=''>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_aluno){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' $selected>$b";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Nota:<td>";
echo "<input type='text' name='nota' id='nota' value='$nota' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Frequência:<td>";
echo "<input type='text' name='frequencia' id='frequencia' value='$frequencia' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Situação:<td>";
echo "<select name='situacao' id='situacao' class='form_select'>";
echo "<option value=''>:: Selecione ::";
   if(AP == $situacao){$selected = 'selected';}else{$selected='';}
echo "<option value='AP' $selected>aprovado";
   if(RP == $situacao){$selected = 'selected';}else{$selected='';}
echo "<option value='RP' $selected>reprovado";
echo "</select>";
echo "</select>";
echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "              </table>";
echo "     </table>";
echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
?>
