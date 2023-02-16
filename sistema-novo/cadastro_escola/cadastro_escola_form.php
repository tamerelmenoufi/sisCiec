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
alert('Campo descricao é obrigatório!');
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

  if($opc == 1){
    $query = "update cadastro_escola set op='0'";
	mysql_query($query);
  }
$query = " insert into cadastro_escola ( ";
$query .= " descricao,";
$query .= " unidade_federada,";
$query .= " op";
$query .= " ) values (";
$query .= " '$descricao',";
$query .= " '$unidade_federada',";
$query .= " '$opc'";
$query .= " )";
$result = mysql_query($query);
$cod = mysql_insert_id();
logs('cadastro_escola','insert',$cod,$query);

echo "<script>window.location.href='cadastro_escola.php?id=$id'</script>";
}
elseif(isset($alterar)){

  if($opc == 1){
    $query = "update cadastro_escola set op='0'";
	mysql_query($query);
	logs('cadastro_escola','update',$cod,$query);
  }

$query = " update cadastro_escola set";
$query .= " descricao='$descricao',";
$query .= " unidade_federada='$unidade_federada',";
$query .= " op='$opc'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('cadastro_escola','update',$codigo,$query);
echo "<script>window.location.href='cadastro_escola.php?id=$id'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='cadastro_escola.php?id=$id'</script>";
}


if($op == 'editar'){

  $xdisabled = 'disabled';
  $tit = 'Editar ';
  $query  = " select ";
  $query .= "cadastro_escola.codigo,";
  $query .= "cadastro_escola.descricao, ";
  $query .= "cadastro_escola.unidade_federada, ";
  $query .= "cadastro_escola.op ";
  $query .= " from cadastro_escola where cadastro_escola.codigo='$cod'";
  $result = mysql_query($query);
  list(
                   $codigo,
                   $descricao,
                   $unidade_federada,
                   $opc
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
echo "                  <td colspan='2' class='titulos_modelos'>$tit Escolas";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Descricao:<td>";
echo "<input type='text' name='descricao' id='descricao' value='$descricao' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Unidade Federada:<td>";
echo "<input type='text' name='unidade_federada' id='unidade_federada' value='$unidade_federada' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Selecionado:<td>";
if($opc == 1){ $checked = 'checked'; }else{ $checked=false; }
echo "<input type='checkbox' name='opc' id='opc' value='1' class='form_checkbox' $checked><br>";
echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes;
echo "              </table>";
echo "     </table>";
echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
//atualizações
?>
