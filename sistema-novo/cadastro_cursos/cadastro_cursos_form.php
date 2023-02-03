<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../calendario/calendar1.js");
?>
<script language='javascript'>
function validar(){

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
$query = " insert into cadastro_cursos ( ";
$query .= " descricao,";
$query .= " tipo,";
$query .= " idade";
$query .= " ) values (";
$query .= " '$descricao',";
$query .= " '$tipo',";
$query .= " '$idade'";
$query .= " )";
$result = mysql_query($query);
$cod = mysql_insert_id();
logs('cadastro_cursos','insert',$cod,$query);

echo "<script>window.location.href='cadastro_cursos.php?id=$id'</script>";
}
elseif(isset($alterar)){
$query = " update cadastro_cursos set";
$query .= " descricao='$descricao',";
$query .= " tipo='$tipo',";
$query .= " idade='$idade'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('cadastro_cursos','update',$codigo,$query);
echo "<script>window.location.href='cadastro_cursos.php?id=$id'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='cadastro_cursos.php?id=$id'</script>";
}

if($op == 'editar'){

    $xdisabled = 'disabled';
    $tit = 'Editar ';
    $query  = " select ";
    $query .= "cadastro_cursos.codigo,";
    $query .= "cadastro_cursos.descricao, ";
    $query .= "cadastro_cursos.tipo, ";
    $query .= "cadastro_cursos.idade ";
    $query .= " from cadastro_cursos where cadastro_cursos.codigo='$cod'";
    $result = mysql_query($query);
    list(
                     $codigo,
                     $descricao,
                     $tipo,
                     $idade
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
echo "                  <td colspan='2' class='titulos_modelos'>$tit Cursos";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Descri��o:<td>";
echo "<input type='text' name='descricao' id='descricao' value='$descricao' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Tipo:<td>";
echo "<input type='text' name='tipo' id='tipo' value='$tipo' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Idade M�nima:<td>";
echo "<input type='text' name='idade' id='idade' value='$idade' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "              </table>";
echo "     </table>";
echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
?>
