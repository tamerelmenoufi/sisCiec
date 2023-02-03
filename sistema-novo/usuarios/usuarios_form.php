<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
if($_SESSION[cook_perfil] != 'a'){ header("location:../principal/index.php"); exit(); }
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../calendario/calendar1.js");
?>
<script language='javascript'>
function validar(){

//validar campo nome
if(!document.all.f.nome.value){
alert('Campo nome é obrigatório!');
document.all.f.nome.focus();
return false;
}

//validar campo telefone
if(!document.all.f.telefone.value){
alert('Campo telefone é obrigatório!');
document.all.f.telefone.focus();
return false;
}
//validar campo telefone
if(!document.all.f.email.value){
alert('Campo email é obrigatório!');
document.all.f.email.focus();
return false;
}
//validar campo telefone
if(!document.all.f.endereco.value){
alert('Campo endereco é obrigatório!');
document.all.f.endereco.focus();
return false;
}
//validar campo telefone
if(!document.all.f.login.value){
alert('Campo login é obrigatório!');
document.all.f.login.focus();
return false;
}
//validar campo telefone
if(!document.all.f.senha.value){
alert('Campo senha é obrigatório!');
document.all.f.senha.focus();
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
$query .= "usuarios.codigo,";
$query .= "usuarios.nome, ";
$query .= "usuarios.telefone, ";
$query .= "usuarios.email, ";
$query .= "usuarios.endereco, ";
$query .= "usuarios.login, ";
$query .= "usuarios.senha, ";
$query .= "usuarios.perfil, ";
$query .= "usuarios.dias, ";
$query .= "usuarios.horarios, ";
$query .= "usuarios.situacao ";
$query .= " from usuarios where usuarios.codigo='$cod'";
$result = mysql_query($query);
list(
                 $codigo,
                 $nome,
				 $telefone,
                 $email,
                 $endereco,
                 $login,
				 $senha,
                 $perfil,
				 $dias,
				 $horas,
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
	
	$dias = @implode("|",$_POST[di]);
	$horas = trim($hora_inicio).":".trim($minuto_inicio)."|".trim($hora_final).":".trim($minuto_final);
	
$query = " insert into usuarios ( ";
$query .= " nome,";
$query .= " telefone,";
$query .= " email,";
$query .= " endereco,";
$query .= " login,";
$query .= " senha,";
$query .= " perfil,";
$query .= " dias,";
$query .= " horarios,";
$query .= " situacao";
$query .= " ) values (";
$query .= " '$nome',";
$query .= " '$telefone',";
$query .= " '$email',";
$query .= " '$endereco',";
$query .= " '$login',";
$query .= " '$senha',";
$query .= " '$perfil',";
$query .= " '$dias',";
$query .= " '$horas',";
$query .= " '$situacao'";
$query .= " )";
$result = mysql_query($query);

$codigo = mysql_insert_id();
logs('usuarios','insert',$codigo,$query);

$codigo = $conf[Unidade].$codigo;

echo "<script>window.location.href='usuarios_form.php?id=$id&op=editar&cod=$codigo'</script>";
}
elseif(isset($alterar)){
	
	$dias = @implode("|",$_POST[di]);
	$horas = trim($hora_inicio).":".trim($minuto_inicio)."|".trim($hora_final).":".trim($minuto_final);
	
$query = " update usuarios set";
$query .= " nome='$nome',";
$query .= " telefone='$telefone',";
$query .= " email='$email',";
$query .= " endereco='$endereco',";
$query .= " login='$login',";
$query .= " senha='$senha',";
$query .= " perfil='$perfil',";
$query .= " dias='$dias',";
$query .= " horarios='$horas',";
$query .= " situacao='$situacao'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('usuarios','update',$codigo,$query);
echo "<script>alert('Perfil alterado com sucesso!')</script>";
echo "<script>window.location.href='usuarios_form.php?id=$id&op=editar&cod=$codigo'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='usuarios.php?id=$id'</script>";
}
echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='f' id='f'>";
echo "<table width='100%' cellspacing='10' cellpadding='0'>";
echo "<tr><td avlign='top'>";
echo "              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "                <tr> ";
echo "                  <td colspan='2' class='titulos_modelos'>$tit Usuários";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Nome:<td>";
echo "<input type='text' name='nome' id='nome' value='$nome' size='' maxlength='' class='form_text'>";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Telefone:<td>";
echo "<input type='text' name='telefone' id='telefone' value='$telefone' size='' maxlength='' class='form_text'>";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "E-mail:<td>";
echo "<input type='text' name='email' id='email' value='$email' size='' maxlength='' class='form_text'>";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Endereço:<td>";
echo "<input type='text' name='endereco' id='endereco' value='$endereco' size='' maxlength='' class='form_text'>";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Login:<td>";
echo "<input type='text' name='login' id='login' value='$login' size='' maxlength='' class='form_text'>";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Senha:<td>";
echo "<input type='password' name='senha' id='senha' value='$senha' size='' maxlength='' class='form_text'>";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Perfil:<td>";
echo "<select name='perfil'>";
echo "<option value=''>:: Selecione o Perfil ::</option>";
if($perfil == 'u'){$selected = 'selected';}else{$selected = false;}
echo "<option value='u' $selected>Usuário</option>";
if($perfil == 'a'){$selected = 'selected';}else{$selected = false;}
echo "<option value='a' $selected>Administrador</option>";
echo "</select>";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Situacao:<td>";
echo "<select name='situacao'>";
echo "<option value=''>:: Selecione a situação ::</option>";
if($situacao == '0'){$selected = 'selected';}else{$selected = false;}
echo "<option value='0' $selected>Bloqueado</option>";
if($situacao == '1'){$selected = 'selected';}else{$selected = false;}
echo "<option value='1' $selected>Ativo</option>";
echo "</select>";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Dias Permitidos:<td>";

$Dias = explode("|",$dias);

echo "<input type='checkbox' name='di[]' value='seg' ".((in_array('seg',$Dias))?'checked':false)."> SEG ";
echo "<input type='checkbox' name='di[]' value='ter' ".((in_array('ter',$Dias))?'checked':false)."> TER ";
echo "<input type='checkbox' name='di[]' value='qua' ".((in_array('qua',$Dias))?'checked':false)."> QUA ";
echo "<input type='checkbox' name='di[]' value='qui' ".((in_array('qui',$Dias))?'checked':false)."> QUI ";
echo "<input type='checkbox' name='di[]' value='sex' ".((in_array('sex',$Dias))?'checked':false)."> SEX ";
echo "<input type='checkbox' name='di[]' value='sab' ".((in_array('sab',$Dias))?'checked':false)."> SAB ";
echo "<input type='checkbox' name='di[]' value='dom' ".((in_array('dom',$Dias))?'checked':false)."> DOM ";

echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Intervalo de Hor&aacute;rios Permitidos:<td>";

$tempo = explode("|",$horas);
$inicio = explode(":",$tempo[0]);
$fim = explode(":",$tempo[1]);

echo "DE: <input type='text' size='2' name='hora_inicio' value='".$inicio[0]."' maxlength='2'>:";
echo "<input type='text' size='2' name='minuto_inicio' value='".$inicio[1]."' maxlength='2'> ";
echo "AT&Eacute;: <input type='text' size='2' name='hora_final' value='".$fim[0]."' maxlength='2'>:";
echo "<input type='text' size='2' name='minuto_final' value='".$fim[1]."' maxlength='2'> ";


echo "<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "              </table>";
echo "     </table>";


echo "     </table>";
include("../includes/rodape.inc.php");
echo "		      </form> ";
?>
