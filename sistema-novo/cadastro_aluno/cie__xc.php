<?php

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nCurso:<td>";
$sql = "select codigo,descricao from cadastro_cursos";
$sql_result = mysql_query($sql);
echo "\n<select name='codigo_curso' id='codigo_curso' class='form_select' onchange=\"window.location.href='$PHP_SELF?codigo_escola=$codigo_escola&codigo_curso='+this.value+'&op=$op&id=$id&cod=$cod#mat'\">"; 
echo "\n<option value=''>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_curso){$selected = 'selected';}else{$selected='';}
echo "\n<option value='$a' $selected>$b";
}
echo "\n</select>";
echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nDisciplina:<td>";
$sql = "select codigo,descricao from cadastro_disciplinas where codigo_curso='$codigo_curso'";
$sql_result = mysql_query($sql);
echo "\n<select name='codigo_disciplina' id='codigo_disciplina' class='form_select' onchange=\"window.location.href='$PHP_SELF?codigo_escola=$codigo_escola&codigo_disciplina='+this.value+'&codigo_curso=$codigo_curso&op=$op&id=$id&cod=$cod#mat'\">";
echo "\n<option value='' id='opcoes'>:: Selecione ::";
while(list($a,$b)=mysql_fetch_row($sql_result)){
   if($a == $codigo_disciplina){$selected = 'selected';}else{$selected='';}
echo "\n<option value='$a' id='opcoes' $selected>$b";
}
echo "\n</select>";
echo "\n<select name='obs' id='obs' class='form_select' style='width:150px' >";
echo "\n<option value='' id='opcoes'>:: Selecione ::";
echo "\n<option value='Ingl&ecirc;s'>Ingl&ecirc;s";
echo "\n<option value='Espanhol'>Espanhol";
echo "\n</select>";
echo "\n<tr class='bg_form'><td align='right' valign='top' class='titulo_campo'>";
echo "\nTurmas:<td>";
$sql = "select a.*,b.nome from turmas a 
        left join cadastro_professor b on a.codigo_professor = b.codigo
				where a.codigo_curso='$codigo_curso' and a.codigo_disciplina='$codigo_disciplina'
				and NOW() <= data_final order by a.data_inicio";
//				and data_inicio <= NOW() and data_final >= NOW() order by a.data_inicio";				
$sql_result = mysql_query($sql);

echo "\n<table width='100%'>";
while($dados = mysql_fetch_object($sql_result)){
echo "\n<tr><td><input type='radio' name='codigo_turma' id='codigo_turma' value='".$dados->codigo."'>";
echo "\n<td><b>Professor:</b><br>".$dados->nome;
echo "\n<td><b>Turno:</b><br>".$dados->turno;
echo "\n<td><b>Início:</b><br>".data_formata($dados->data_inicio);
echo "\n<td><b>Final:</b><br>".data_formata($dados->data_final);
echo "\n<td><b>Entada:</b><br>".$dados->hora_inicio;
echo "\n<td><b>Saída:</b><br>".$dados->hora_final;
echo "\n<td><b>Exame:</b><br>".data_formata($dados->data_exame);
}
if(!mysql_num_rows($sql_result)){
echo "\n<input type='hidden' name='codigo_turma' value=''>";
}
echo "\n</table>";
echo "\n<input type='hidden' name='codigo_aluno' value='$cod'>";
echo "\n<input type='hidden' name='cod' value='$cod'>";
echo "\n<input type='hidden' name='op' value='$op'>";
echo "\n<input type='hidden' name='id' value='$id'>";




echo "\n<tr class='bg_form'><td colspan='2' align='center'>";
echo "\n<input type='submit' name='matricular' class='botao_alterar' value='Matricular' title='Matricular' onclick=\"return validar_matricula(document.all.f.codigo_curso.value,'$IdadeAluno');\">";
echo "\n              </table>";

echo "\n     </table>";


?>