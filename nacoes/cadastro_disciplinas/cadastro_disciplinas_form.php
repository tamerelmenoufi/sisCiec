<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../calendario/calendar1.js");
?>
<script language='javascript'>
function validar(){

//validar campo codigo_curso
if(!document.all.f.codigo_curso.value){
alert('Campo codigo_curso obrigatorio!');
document.all.f.codigo_curso.focus();
return false;
}

//validar campo descricao
if(!document.all.f.descricao.value){
alert('Campo descricao obrigatorio!');
document.all.f.descricao.focus();
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
$query = " insert into cadastro_disciplinas ( ";
$query .= " codigo_curso,";
$query .= " descricao";
$query .= " ) values (";
$query .= " '$codigo_curso',";
$query .= " '$descricao'";
$query .= " )";
$result = mysql_query($query);
$cod = mysql_insert_id();
logs('cadastro_disciplinas','insert',$cod,$query);

echo "<script>window.location.href='cadastro_disciplinas.php?id=$id'</script>";
}
elseif(isset($alterar)){
$query = " update cadastro_disciplinas set";
$query .= " codigo_curso='$codigo_curso',";
$query .= " descricao='$descricao'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('cadastro_disciplinas','update',$codigo,$query);
echo "<script>window.location.href='cadastro_disciplinas.php?id=$id'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='cadastro_disciplinas.php?id=$id'</script>";
}

if($op == 'editar'){

   $xdisabled = 'disabled';
   $tit = 'Editar ';
   $query  = " select ";
   $query .= "cadastro_disciplinas.codigo,";
   $query .= "cadastro_disciplinas.codigo_curso, ";
   $query .= "cadastro_disciplinas.descricao ";
   $query .= " from cadastro_disciplinas where cadastro_disciplinas.codigo='$cod'";
   $result = mysql_query($query);
   list(
                    $codigo,
                    $codigo_curso,
                    $descricao
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
echo "                  <td colspan='2' class='titulos_modelos'>$tit Disciplinas";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Curso:<td>";
$sql = "select codigo,descricao,tipo from cadastro_cursos";
$sql_result = mysql_query($sql);
echo "<select name='codigo_curso' id='codigo_curso' class='form_select'>";
echo "<option value=''>:: Selecione ::";
while(list($a,$b,$c)=mysql_fetch_row($sql_result)){
   if($a == $codigo_curso){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' $selected>$b ($c)";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Descri&ccedil;&atilde;o:<td>";
echo "<input type='text' name='descricao' id='descricao' value='$descricao' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "              </table>";
echo "     </table>";
echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
?>
