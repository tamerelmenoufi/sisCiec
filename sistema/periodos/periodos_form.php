<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/connect.inc.php");
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
if($op == 'editar'){

$xdisabled = 'disabled';
$tit = 'Editar ';
$query  = " select ";
$query .= "periodos.codigo,";
$query .= "periodos.descricao, ";
$query .= "periodos.data_inicial, ";
$query .= "periodos.data_final ";
$query .= " from periodos where periodos.codigo='$cod'";
$result = mysql_query($query);
list(
                 $codigo,
                 $descricao,
				 $data_inicial,
				 $data_final
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
$query = " insert into periodos ( ";
$query .= " descricao,";
$query .= " data_inicial,";
$query .= " data_final";
$query .= " ) values (";
$query .= " '$descricao',";
$query .= " '".data_formata($data_inicial)."',";
$query .= " '".data_formata($data_final)."'";
$query .= " )";
$result = mysql_query($query);
$cod = mysql_insert_id();
logs('periodos','insert',$cod,$query);

echo "<script>window.location.href='periodos.php?id=$id'</script>";
}
elseif(isset($alterar)){
$query = " update periodos set";
$query .= " descricao='$descricao',";
$query .= " data_inicial='".data_formata($data_inicial)."',";
$query .= " data_final='".data_formata($data_final)."'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('periodos','update',$codigo,$query);
echo "<script>window.location.href='periodos.php?id=$id'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='periodos.php?id=$id'</script>";
}
echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='f' id='f'>";
echo "<table width='100%' cellspacing='10' cellpadding='0'>";
echo "<tr><td avlign='top'>";
echo "              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "                <tr> ";
echo "                  <td colspan='2' class='titulos_modelos'>$tit Per&iacute;odos";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Descrição:<td>";
echo "<input type='text' name='descricao' id='descricao' value='$descricao' size='' maxlength='' class='form_text'>";


echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nData de Inicial:<td>";
echo "\n<input type='text' name='data_inicial' id='data_inicial' value='".data_formata($data_inicial)."' size='' maxlength='' class='form_text'>";
echo "\n <a href='javascript:cal2.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
echo "\n		\n<script language='JavaScript'>\n";
echo "\n		<!-- \n";
echo "\n			var cal2 = new calendar1(document.f.data_inicial);\n";
echo "\n			cal2.year_scroll = true;\n";
echo "\n			//cal2.time_comp = true;\n";
echo "\n		//-->\n";
echo "\n		</script>\n";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nData de Final:<td>";
echo "\n<input type='text' name='data_final' id='data_final' value='".data_formata($data_final)."' size='' maxlength='' class='form_text'>";
echo "\n <a href='javascript:cal3.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
echo "\n		\n<script language='JavaScript'>\n";
echo "\n		<!-- \n";
echo "\n			var cal3 = new calendar1(document.f.data_final);\n";
echo "\n			cal3.year_scroll = true;\n";
echo "\n			//cal3.time_comp = true;\n";
echo "\n		//-->\n";
echo "\n		</script>\n";


echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "              </table>";
echo "     </table>";
echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
?>
