<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/connect.inc.php");
include("../calendario/calendar1.js");
?>
<script language='javascript'>
function validar(){

//validar campo codigo_professor
if(!document.all.f.codigo_professor.value){
alert('Campo codigo_professor é obrigatório!');
document.all.f.codigo_professor.focus();
return false;
}

//validar campo codigo_disciplina
if(!document.all.f.codigo_disciplina.value){
alert('Campo codigo_disciplina é obrigatório!');
document.all.f.codigo_disciplina.focus();
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
$query .= "professor_disciplina.codigo,";
$query .= "professor_disciplina.codigo_curso, ";
$query .= "professor_disciplina.codigo_professor, ";
$query .= "professor_disciplina.codigo_disciplina ";
$query .= " from professor_disciplina where professor_disciplina.codigo='$cod'";
$result = mysql_query($query);
list(
                 $codigo,
                 $codigo_curso,
								 $codigo_professor,
                 $codigo_disciplina
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
$query = " insert into professor_disciplina ( ";
$query .= " codigo_curso,";
$query .= " codigo_professor,";
$query .= " codigo_disciplina";
$query .= " ) values (";
$query .= " '$codigo_curso',";
$query .= " '$codigo_professor',";
$query .= " '$codigo_disciplina'";
$query .= " )";
$result = mysql_query($query);
$cod = mysql_insert_id();
logs('professor_disciplina','insert',$cod,$query);

echo "<script>window.location.href='professor_disciplina.php?id=$id'</script>";
}
elseif(isset($alterar)){
$query = " update professor_disciplina set";
$query .= " codigo_curso='$codigo_curso',";
$query .= " codigo_professor='$codigo_professor',";
$query .= " codigo_disciplina='$codigo_disciplina'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('professor_disciplina','update',$codigo,$query);
echo "<script>window.location.href='professor_disciplina.php?id=$id'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='professor_disciplina.php?id=$id'</script>";
}
echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='f' id='f'>";
echo "<table width='100%' cellspacing='10' cellpadding='0'>";
echo "<tr><td avlign='top'>";
echo "              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "                <tr> ";
echo "                  <td colspan='2' class='titulos_modelos'>$tit Professor / Disciplinas";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Curso:<td>";
$sql = "select codigo,descricao from cadastro_cursos";
$sql_result = mysql_query($sql);
echo "<select name='codigo_curso' id='codigo_curso' class='form_select' onchange=\"window.location.href='$PHP_SELF?codigo_curso='+this.value+'&op=$op&id=$id&cod=$cod'\">";
echo "<option value=''>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_curso){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' $selected>$b";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Disciplina:<td>";
$sql = "select codigo,descricao from cadastro_disciplinas where codigo_curso='$codigo_curso'";
$sql_result = mysql_query($sql);
echo "<select name='codigo_disciplina' id='codigo_disciplina' class='form_select'>";
echo "<option value=''>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_disciplina){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' $selected>$b";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Professor:<td>";
$sql = "select codigo,nome from cadastro_professor";
$sql_result = mysql_query($sql);
echo "<select name='codigo_professor' id='codigo_professor' class='form_select'>";
echo "<option value=''>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_professor){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' $selected>$b";
}
echo "</select>";
echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "              </table>";
echo "     </table>";
echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
?>
