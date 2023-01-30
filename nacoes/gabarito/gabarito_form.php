<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/connect.inc.php");
include("../calendario/calendar1.js");
?>
<script language='javascript'>
function validar(){

//validar campo turma
if(!document.all.f.turma.value){
alert('Campo turma é obrigatório!');
document.all.f.turma.focus();
return false;
}

//validar campo ordem
if(!document.all.f.ordem.value){
alert('Campo ordem é obrigatório!');
document.all.f.ordem.focus();
return false;
}

//validar campo resposta
if(!document.all.f.resposta.value){
alert('Campo resposta é obrigatório!');
document.all.f.resposta.focus();
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
$query .= "gabarito.codigo,";
$query .= "gabarito.turma, ";
$query .= "gabarito.ordem, ";
$query .= "gabarito.resposta ";
$query .= " from gabarito where gabarito.codigo='$cod'";
$result = mysql_query($query);
list(
                 $codigo,
                 $turma,
                 $ordem,
                 $resposta
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
$query = " insert into gabarito ( ";
$query .= " turma,";
$query .= " ordem,";
$query .= " resposta";
$query .= " ) values (";
$query .= " '$turma',";
$query .= " '$ordem',";
$query .= " '$resposta'";
$query .= " )";
$result = mysql_query($query);
$cod = mysql_insert_id();
logs('gabarito','insert',$cod,$query);

echo "<script>window.location.href='gabarito.php?id=$id'</script>";
}
elseif(isset($alterar)){
$query = " update gabarito set";
$query .= " turma='$turma',";
$query .= " ordem='$ordem',";
$query .= " resposta='$resposta'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('gabarito','update',$codigo,$query);
echo "<script>window.location.href='gabarito.php?id=$id'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='gabarito.php?id=$id'</script>";
}
echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='f' id='f'>";
echo "<table width='100%' cellspacing='10' cellpadding='0'>";
echo "<tr><td avlign='top'>";
echo "              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "                <tr> ";
echo "                  <td colspan='2' class='titulos_modelos'>$tit Gabarito";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Turma:<td>";
$sql = "select codigo,codigo from turmas";
$sql_result = mysql_query($sql);
echo "<select name='turma' id='turma' class='form_select'>";
echo "<option value=''>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $turma){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' $selected>$b";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Ordem:<td>";
echo "<input type='text' name='ordem' id='ordem' value='$ordem' size='' maxlength='' class='form_text'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Resposta:<td>";
   if(A == $resposta){$selected = 'checked';}else{$selected='';}
echo "<input type='radio' name='resposta' id='resposta' value='A' class='form_radio' $selected>A<br>";
   if(B == $resposta){$selected = 'checked';}else{$selected='';}
echo "<input type='radio' name='resposta' id='resposta' value='B' class='form_radio' $selected>B<br>";
   if(C == $resposta){$selected = 'checked';}else{$selected='';}
echo "<input type='radio' name='resposta' id='resposta' value='C' class='form_radio' $selected>C<br>";
   if(D == $resposta){$selected = 'checked';}else{$selected='';}
echo "<input type='radio' name='resposta' id='resposta' value='D' class='form_radio' $selected>D<br>";
   if(E == $resposta){$selected = 'checked';}else{$selected='';}
echo "<input type='radio' name='resposta' id='resposta' value='E' class='form_radio' $selected>E<br>";
echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "              </table>";
echo "     </table>";
echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
?>
