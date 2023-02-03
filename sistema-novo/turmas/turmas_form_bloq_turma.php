<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/connect.inc.php");

include("../calendario/calendar1.js");
include("./ajax1.php");
include("./ajax2.php");

    function checar_gabarito($t,$p,$r){
		   $query = "select * from gabarito where turma='$t' and ordem='$p' and resposta='$r'";
			 $result = mysql_query($query);
			 if(mysql_num_rows($result)){
			    return checked;
			 }else{
			   return false;
			 }
		}


?>
<script language='javascript'>
function validar(opc){

if(opc == 'duplicar'){
     if(confirm('deseja relamente duplicar a turma?')){
           return true;
     }else{ return false; }
}

//validar campo codigo_curso
if(!document.all.f.codigo_curso.value){
alert('Campo codigo_curso é obrigatório!');
document.all.f.codigo_curso.focus();
return false;
}

//validar campo codigo_disciplina
if(!document.all.f.codigo_disciplina.value){
alert('Campo codigo_disciplina é obrigatório!');
document.all.f.codigo_disciplina.focus();
return false;
}

//validar campo codigo_professor
if(!document.all.f.codigo_professor.value){
alert('Campo codigo_professor é obrigatório!');
document.all.f.codigo_professor.focus();
return false;
}

//validar campo data_inicio
if(!document.all.f.data_inicio.value){
alert('Campo data_inicio é obrigatório!');
document.all.f.data_inicio.focus();
return false;
}

//validar campo data_final
if(!document.all.f.data_final.value){
alert('Campo data_final é obrigatório!');
document.all.f.data_final.focus();
return false;
}

//validar campo data_exame
if(!document.all.f.data_exame.value){
alert('Campo data_exame é obrigatório!');
document.all.f.data_exame.focus();
return false;
}

//validar campo turno
if(!document.all.f.turno.value){
alert('Campo turno é obrigatório!');
document.all.f.turno.focus();
return false;
}

//validar campo hora_inicio
if(!document.all.f.hora_inicio.value){
alert('Campo hora_inicio é obrigatório!');
document.all.f.hora_inicio.focus();
return false;
}

//validar campo hora_final
if(!document.all.f.hora_final.value){
alert('Campo hora_final é obrigatório!');
document.all.f.hora_final.focus();
return false;
}
return true;
}

function datas(dt,dt1){
   
   var d1 = (dt.getDate() < 10 ? '0' : '') + dt.getDate();
   var m1 = ((dt.getMonth()+1) < 10 ? '0' : '') + (dt.getMonth()+1);
   var a1 = dt.getFullYear();
   
   document.all.f.data_final.value = d1 + '-' + m1 + '-' + a1;
   
   var d2 = (dt1.getDate() < 10 ? '0' : '') + dt1.getDate();
   var m2 = ((dt1.getMonth()+1) < 10 ? '0' : '') + (dt1.getMonth()+1);
   var a2 = dt1.getFullYear();
   
   document.all.f.data_exame.value = d2 + '-' + m2 + '-' + a2;
   
   
}

function NoneDiv(){
		document.all.DivMat.style.display='none';
		document.all.DivVes.style.display='none';
		document.all.DivNot.style.display='none';
}


function horarios(hor){
	
	NoneDiv();
	
	if(hor == 'matutino'){
		DivHorario.innerHTML = 'Horário Matutino';
		document.all.DivMat.style.display='block';
	}
	if(hor == 'vespertino'){
		DivHorario.innerHTML = 'Horário Vespertino';
		document.all.DivVes.style.display='block';
	}
	if(hor == 'noturno'){
		DivHorario.innerHTML = 'Horário Noturno';
		document.all.DivNot.style.display='block';
	}
	if(!hor){
		DivHorario.innerHTML = '';
	}

}


</script>

<?php
if($op == 'editar'){

list($tem_matricula) = mysql_fetch_row(mysql_query("select count(codigo) from matricula where codigo_turma = '".$cod."'  "));

$xdisabled = 'disabled';
$tit = 'Editar ';
$query  = " select ";
$query .= "turmas.codigo,";
$query .= "turmas.codigo_turma, ";
$query .= "turmas.codigo_escola, ";
$query .= "turmas.codigo_curso, ";
$query .= "turmas.codigo_disciplina, ";
$query .= "turmas.codigo_professor, ";
$query .= "turmas.data_inicio, ";
$query .= "turmas.data_final, ";
$query .= "turmas.data_exame, ";
$query .= "turmas.turno, ";
$query .= "turmas.hora_inicio, ";
$query .= "turmas.hora_final ";
$query .= " from turmas where turmas.codigo='$cod'";
$result = mysql_query($query);
list(
                 $codigo,
				 $codigo_turma,
                 $codigo_escola,
				 $codigo_curso,
                 $codigo_disciplina,
                 $codigo_professor,
                 $data_inicio,
                 $data_final,
                 $data_exame,
                 $turno,
                 $hora_inicio,
                 $hora_final
		 ) = mysql_fetch_row($result);
$botoes  = "<input type='hidden' name='codigo' value='$codigo'>";
$botoes .= "<input type='hidden' name='id' value='$id'>";
$botoes .= "<input type='submit' name='alterar' class='botao_alterar' value='Alterar' title='Alterar' onclick='return validar();' ".(($tem_matricula)?'disabled':false).">";
$botoes .= " <input type='submit' name='duplicar' class='botao_alterar' value='Duplicar' title='Duplicar' onclick='return validar(this.name);'>";
$botoes .= " <input type='submit' name='cancelar' class='botao_alterar' value='Cancelar' title='Cancelar' >";
if($_SESSION['cook_perfil'] == 'a'){
$botoes .= " <input type='button' name='permissoes' class='botao_alterar' value='Permissoes' title='Permissoes aos usuarios' onclick=\"window.open('../permissoes/turmas.php?tipo=turma&codigo_tipo=$codigo','perm','width=500,height=450')\" >";
}
}

elseif($op == 'novo'){

$xdisabled = '';
$tit = 'Inserir ';

$botoes = "<input type='hidden' name='id' value='$id'>";
$botoes .= "<input type='submit' name='inserir' class='botao_alterar' value='Inserir' title='Inserir' onclick='return validar();'>";
$botoes .= " <input type='submit' name='cancelar' class='botao_alterar' value='Cancelar' title='Cancelar' >";
}

if (isset($inserir)){

list($hora_inicio,$hora_final) = explode("|",$tempo);

$query = " insert into turmas ( ";
$query .= " codigo_turma,";
$query .= " codigo_escola,";
$query .= " codigo_curso,";
$query .= " codigo_disciplina,";
$query .= " codigo_professor,";
$query .= " data_inicio,";
$query .= " data_final,";
$query .= " data_exame,";
$query .= " turno,";
$query .= " hora_inicio,";
$query .= " hora_final";
$query .= " ) values (";
$query .= " '$codigo_turma',";
$query .= " '$codigo_escola',";
$query .= " '$codigo_curso',";
$query .= " '$codigo_disciplina',";
$query .= " '$codigo_professor',";
$query .= " '".data_formata($data_inicio)."',";
$query .= " '".data_formata($data_final)."',";
$query .= " '".data_formata($data_exame)."',";
$query .= " '$turno',";
$query .= " '$hora_inicio',";
$query .= " '$hora_final'";
$query .= " )";
$result = mysql_query($query);
$n = mysql_insert_id();
logs('turmas','insert',$n,$query);

//dados do gabarito
    for($i=1;$i<=60;$i++){
		 eval("\$dado = \"$".'p'.$i."\";");
		   if($dado){
		   $pergunta[]=$i; $resposta[]=$dado;
			 }
		}
//inserir gabarito
    for($i=0;$i<count($pergunta);$i++){
		   $query = "insert into gabarito (turma,ordem,resposta) values ('$n','$pergunta[$i]','$resposta[$i]')";
			 $result = mysql_query($query);
			$cod = mysql_insert_id();
			logs('gabarito','insert',$cod,$query);
		}




echo "<script>window.location.href='turmas_form.php?id=$id&op=editar&cod=".$n."'</script>";
}

elseif (isset($duplicar)){

list($hora_inicio,$hora_final) = explode("|",$tempo);

$query = " insert into turmas ( ";
$query .= " codigo_escola,";
$query .= " codigo_curso,";
$query .= " codigo_disciplina,";
$query .= " codigo_professor,";
$query .= " data_inicio,";
$query .= " data_final,";
$query .= " data_exame,";
$query .= " turno,";
$query .= " hora_inicio,";
$query .= " hora_final";
$query .= " ) values (";
$query .= " '$codigo_escola',";
$query .= " '$codigo_curso',";
$query .= " '$codigo_disciplina',";
$query .= " '$codigo_professor',";
$query .= " '".data_formata($data_inicio)."',";
$query .= " '".data_formata($data_final)."',";
$query .= " '".data_formata($data_exame)."',";
$query .= " '$turno',";
$query .= " '$hora_inicio',";
$query .= " '$hora_final'";
$query .= " )";
$result = mysql_query($query);
$n = mysql_insert_id();
logs('turmas','insert',$n,$query);

//dados do gabarito
    for($i=1;$i<=60;$i++){
		 eval("\$dado = \"$".'p'.$i."\";");
		   if($dado){
		   $pergunta[]=$i; $resposta[]=$dado;
			 }
		}
//inserir gabarito
    
    for($i=0;$i<count($pergunta);$i++){
		   $query = "insert into gabarito (turma,ordem,resposta) values ('$n','$pergunta[$i]','$resposta[$i]')";
			 $result = mysql_query($query);
			$cod = mysql_insert_id();
			logs('gabarito','insert',$cod,$query);
		}



echo "<script>alert('Dados duplicados com sucesso !');</script>";
echo "<script>window.location.href='turmas_form.php?id=$id&op=editar&cod=".$n."'</script>";
}


elseif(isset($alterar)){

list($hora_inicio,$hora_final) = explode("|",$tempo);

$query = " update turmas set";
$query .= " codigo_turma='$codigo_turma',";
$query .= " codigo_escola='$codigo_escola',";
$query .= " codigo_curso='$codigo_curso',";
$query .= " codigo_disciplina='$codigo_disciplina',";
$query .= " codigo_professor='$codigo_professor',";
$query .= " data_inicio='".data_formata($data_inicio)."',";
$query .= " data_final='".data_formata($data_final)."',";
$query .= " data_exame='".data_formata($data_exame)."',";
$query .= " turno='$turno',";
$query .= " hora_inicio='$hora_inicio',";
$query .= " hora_final='$hora_final'";
$query .= " where codigo = '$codigo'";
mysql_query($query);

mysql_query("update matricula set data_exame='".data_formata($data_exame)."' where codigo_turma ='$codigo'");


logs('turmas','update',$codigo,$query);
//dados do gabarito
    for($i=1;$i<=60;$i++){
		 eval("\$dado = \"$".'p'.$i."\";");
		   if($dado){
		   $pergunta[]=$i; $resposta[]=$dado;
			 }
		}
//inserir gabarito
    
		   $query = "delete from gabarito where turma='$codigo'";
			 $result = mysql_query($query);
   
    for($i=0;$i<count($pergunta);$i++){
		   $query = "insert into gabarito (turma,ordem,resposta) values ('$codigo','$pergunta[$i]','$resposta[$i]')";
			 $result = mysql_query($query);
			 logs('gabarito','update',$codigo,$query);
		}

echo "<script>window.location.href='turmas_form.php?id=$id&op=editar&cod=$codigo'</script>";
}
if(isset($cancelar)){
echo "<script>window.location.href='turmas.php?id=$id'</script>";
}
echo "<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='f' id='f'>";
echo "<table width='100%' cellspacing='10' cellpadding='0'>";
echo "<tr><td avlign='top'>";
echo "              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "                <tr> ";
echo "                  <td colspan='2' class='titulos_modelos'>$tit Turmas";
echo "                <tr><td height='5px'></td></tr></table>";
echo "<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "<tr><td valign='top'>";
echo "       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "          <tr><td align='left' valign='top'>";


echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nC&Oacute;DIGO TURMA:<td><font size='6'>$codigo</font>";



echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nEscola:<td>";
$sql = "select codigo,descricao,op from cadastro_escola order by descricao";
$sql_result = mysql_query($sql);
echo "\n<select name='codigo_escola' id='codigo_escola' class='form_select'>"; 
echo "\n<option value=''>:: Selecione ::";
while(list($a,$b,$c)=mysql_fetch_row($sql_result)){
   if($c == '1' and !$codigo_escola){$selected = 'selected';}
   elseif($a == $codigo_escola) {$selected = 'selected';}else{$selected='';}
echo "\n<option value='$a' $selected>$b";
}
echo "\n</select>";


echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Curso:<td>";
$sql = "select codigo,descricao,tipo from cadastro_cursos";
$sql_result = mysql_query($sql);
echo "<select name='codigo_curso' id='codigo_curso' class='form_select' onchange=\"Dados2(''); Dados1(this.value);\">"; //onchange=\"window.location.href='$PHP_SELF?codigo_curso='+this.value+'&op=$op&id=$id&cod=$cod'\"
echo "<option value=''>:: Selecione ::";
while(list($a,$b,$c)=mysql_fetch_row($sql_result)){
   if($a == $codigo_curso){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' $selected>$b ($c)";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Disciplina:<td>";
$sql = "select codigo,descricao from cadastro_disciplinas where codigo_curso='$codigo_curso'";
$sql_result = mysql_query($sql);
echo "<select name='codigo_disciplina' id='codigo_disciplina' class='form_select' onchange=\"Dados2(this.value);\">"; // onchange=\"window.location.href='$PHP_SELF?codigo_professor='+this.value+'&codigo_curso=$codigo_curso&op=$op&id=$id&cod=$cod'\"
echo "<option value='' id='opcoes'>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_disciplina){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' id='opcoes' $selected>$b";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Professor:<td>";
$sql = " 
       SELECT a.codigo, a.nome    
        FROM  cadastro_professor a 
		left join professor_disciplina b on a.codigo=b.codigo_professor
		where b.codigo_disciplina = '".$codigo_disciplina."'
		ORDER BY a.nome";
		//echo $sql;
$sql_result = mysql_query($sql);
echo "<select name='codigo_professor' id='codigo_professor' class='form_select'>";
echo "<option value='' id='opcoes1'>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_professor){$selected = 'selected';}else{$selected='';}
echo "<option value='$a' id='opcoes1' $selected>$b";
}
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Data de Início:<td>";
echo "<input type='text' name='data_inicio' id='data_inicio' value='".data_formata($data_inicio)."' size='' maxlength='' class='form_text'>"; // onfocus=\"datas(this.value)\"
echo " <a href='javascript:cal1.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
echo "		\n<script language='JavaScript'>\n";
echo "		<!-- \n";
echo "			var cal1 = new calendar1(document.f.data_inicio);\n";
echo "			cal1.year_scroll = true;\n";
echo "			//cal1.time_comp = true;\n";
echo "		//-->\n";
echo "		</script>\n";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Data Final:<td>";
echo "<input type='text' name='data_final' id='data_final' value='".data_formata($data_final)."' size='' maxlength='' class='form_text'>";
//echo " <a href='javascript:cal2.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
echo "		\n<script language='JavaScript'>\n";
echo "		<!-- \n";
echo "			var cal2 = new calendar1(document.f.data_final);\n";
echo "			cal2.year_scroll = true;\n";
echo "			//cal2.time_comp = true;\n";
echo "		//-->\n";
echo "		</script>\n";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Data de Exame:<td>";
echo "<input type='text' name='data_exame' id='data_exame' value='".data_formata($data_exame)."' size='' maxlength='' class='form_text'>";
//echo " <a href='javascript:cal3.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
echo "		\n<script language='JavaScript'>\n";
echo "		<!-- \n";
echo "			var cal3 = new calendar1(document.f.data_exame);\n";
echo "			cal3.year_scroll = true;\n";
echo "			//cal3.time_comp = true;\n";
echo "		//-->\n";
echo "		</script>\n";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Turno:<td>";
echo "<select name='turno' id='turno' class='form_select' onchange='horarios(this.value)'>";
echo "<option value=''>:: Selecione ::";
   if(matutino == $turno){$selected = 'selected'; $displayMat = 'block'; }else{$selected=''; $displayMat = 'none'; }
echo "<option value='matutino' $selected>matutino";
   if(vespertino == $turno){$selected = 'selected'; $displayVes = 'block'; }else{$selected=''; $displayVes = 'none'; }
echo "<option value='vespertino' $selected>vespertino";
   if(noturno == $turno){$selected = 'selected'; $displayNot = 'block'; }else{$selected=''; $displayNot = 'none'; }
echo "<option value='noturno' $selected>noturno";
echo "</select>";
echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "<div id='DivHorario'></div><td>";

//list($hora_inicio,$min_inicio,$seg) = explode(":",$hora_inicio);
//list($hora_final,$min_final,$seg) = explode(":",$hora_final);

echo "<div id='DivMat' style='display:".$displayMat."'>";
if(trim($hora_inicio) == '08:00:00'){ $checked = 'checked'; }else{ $checked = false; }
echo "<input type='radio' name='tempo' id='tempo' value='08:00:00|09:45:00' $checked>";
echo "<span>08:00 as 09:45</span>";
echo "<br>";

if(trim($hora_inicio) == '09:45:00'){ $checked = 'checked'; }else{ $checked = false; }
echo "<input type='radio' name='tempo' id='tempo' value='09:45:00|11:30:00' $checked>";
echo "<span>09:45 as 11:30</span>";
echo "<br>";

echo "</div>";

echo "<div id='DivVes' style='display:".$displayVes."'>";

if(trim($hora_inicio) == '14:30:00'){ $checked = 'checked'; }else{ $checked = false; }
echo "<input type='radio' name='tempo' id='tempo' value='14:30:00|16:15:00' $checked>";
echo "<span>14:30 as 16:15</span>";
echo "<br>";

if(trim($hora_inicio) == '16:15:00'){ $checked = 'checked'; }else{ $checked = false; }
echo "<input type='radio' name='tempo' id='tempo' value='16:15:00|18:00:00' $checked>";
echo "<span>16:15 as 18:00</span>";
echo "<br>";

echo "</div>";

echo "<div id='DivNot' style='display:".$displayNot."'>";

if(trim($hora_inicio) == '18:00:00'){ $checked = 'checked'; }else{ $checked = false; }
echo "<input type='radio' name='tempo' id='tempo' value='18:00:00|19:30:00' $checked>";
echo "<span>18:00 as 19:30</span>";
echo "<br>";

if(trim($hora_inicio) == '19:30:00'){ $checked = 'checked'; }else{ $checked = false; }
echo "<input type='radio' name='tempo' id='tempo' value='19:30:00|21:00:00' $checked>";
echo "<span>19:30 as 21:00</span>";
echo "<br>";

if(trim($hora_inicio) == '21:00:00'){ $checked = 'checked'; }else{ $checked = false; }
echo "<input type='radio' name='tempo' id='tempo' value='21:00:00|22:30:00' $checked>";
echo "<span>21:00 as 22:30</span>";

echo "</div>";


echo "<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "Turma Vinculada:<td>";
echo "<input type='text' name='codigo_turma' id='codigo_turma' value='$codigo_turma' class='form_text'><br>"; // onfocus=\"datas(this.value)\"
if($codigo_turma){
	$sql = "select a.*, b.descricao from turmas a left join cadastro_disciplinas b on a.codigo_disciplina= b.codigo where a.codigo='".$codigo_turma."'";;
	$sql = mysql_query($sql);
	$dt = mysql_fetch_object($sql);
	echo $dt->descricao;
}

echo "<tr class='bg_form'><td colspan='2' align='left' class='titulos_modelos'>";
echo "Gabarito";
echo "<tr class='bg_form'><td colspan='2' align='left'>";

       echo "<table>";
     for($j=0;$j<=5;$j++){
		 echo "<tr>";
	   for($i=1;$i<=20;$i++){
		 if($j == 0){
		 echo "<td align='right'><b>$i</b>";
		 }else{
		     if($j == 1 and $i == 1){ echo "<td><b>A</b>"; $l = "A"; }
	   elseif($j == 2 and $i == 1){ echo "<td><b>B</b>"; $l = "B"; }
	   elseif($j == 3 and $i == 1){ echo "<td><b>C</b>"; $l = "C"; }
	   elseif($j == 4 and $i == 1){ echo "<td><b>D</b>"; $l = "D"; }
	   elseif($j == 5 and $i == 1){ echo "<td><b>E</b>"; $l = "E"; }
	   else{ echo "<td>"; }
		 echo "<input type='radio' name='p".$i."' value='".$l."' title='".$i.' - '.$l."' ".checar_gabarito($codigo,$i,$l).">";
		 }
	   }
	 }

     echo "<tr><td colspan='20'>&nbsp;";
		 for($j=0;$j<=5;$j++){
		 echo "<tr>";
	   for($i=21;$i<=40;$i++){
		 if($j == 0){
		 echo "<td align='right'><b>$i</b>";
		 }else{
		     if($j == 1 and $i == 21){ echo "<td><b>A</b>"; $l = "A"; }
	   elseif($j == 2 and $i == 21){ echo "<td><b>B</b>"; $l = "B"; }
	   elseif($j == 3 and $i == 21){ echo "<td><b>C</b>"; $l = "C"; }
	   elseif($j == 4 and $i == 21){ echo "<td><b>D</b>"; $l = "D"; }
	   elseif($j == 5 and $i == 21){ echo "<td><b>E</b>"; $l = "E"; }
	   else{ echo "<td>"; }
		 echo "<input type='radio' name='p".$i."' value='".$l."' title='".$i.' - '.$l."' ".checar_gabarito($codigo,$i,$l).">";
		 }
	   }
	 }

  	 echo "<tr><td colspan='20'>&nbsp;";
     for($j=0;$j<=5;$j++){
	   echo "<tr>";
	   for($i=41;$i<=60;$i++){
		 if($j == 0){
		 echo "<td align='right'><b>$i</b>";
		 }else{
		     if($j == 1 and $i == 41){ echo "<td><b>A</b>"; $l = "A"; }
	   elseif($j == 2 and $i == 41){ echo "<td><b>B</b>"; $l = "B"; }
	   elseif($j == 3 and $i == 41){ echo "<td><b>C</b>"; $l = "C"; }
	   elseif($j == 4 and $i == 41){ echo "<td><b>D</b>"; $l = "D"; }
	   elseif($j == 5 and $i == 41){ echo "<td><b>E</b>"; $l = "E"; }
	   else{ echo "<td>"; }
		 echo "<input type='radio' name='p".$i."' value='".$l."' title='".$i.' - '.$l."' ".checar_gabarito($codigo,$i,$l).">";
		 }
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
