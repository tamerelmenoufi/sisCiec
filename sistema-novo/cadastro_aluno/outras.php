<?php

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nCurso:<td>";
$sql = "select codigo,descricao,tipo from cadastro_cursos";
$sql_result = mysql_query($sql);
echo "\n<select name='codigo_curso' id='codigo_curso' class='form_select' onchange=\"window.location.href='$PHP_SELF?codigo_escola=$codigo_escola&codigo_curso='+this.value+'&op=$op&id=$id&cod=$cod#mat'\">"; 
echo "\n<option value=''>:: Selecione ::";
while(list($a,$b,$c)=mysql_fetch_row($sql_result)){
   if($a == $codigo_curso){$selected = 'selected';}else{$selected='';}
echo "\n<option value='$a' $selected>$b ($c)";
}
echo "\n</select>";
echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nDisciplina:<td>";
$sql = "select codigo,descricao from cadastro_disciplinas where codigo_curso='$codigo_curso' ".((is_array($VDd)) ? " and codigo not in('".@implode("','",$VDd)."')" : false);
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
echo "\n<option value=' Estrangeira Moderna: Ingl&ecirc;s'> Estrangeira Moderna: Ingl&ecirc;s";
echo "\n<option value=' Espanhola'> Espanhola";
echo "\n</select>";

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.H.<input name='carga_horaria' type='text' size='4' maxlength='3'>";

echo "\n<tr class='bg_form'><td align='right' valign='top' class='titulo_campo'>";
echo "\nTurmas:<td>";
$sql = "select a.*,b.nome from turmas a 
        left join cadastro_professor b on a.codigo_professor = b.codigo
				where a.codigo_curso='$codigo_curso' and a.codigo_disciplina='$codigo_disciplina' limit 0,1";
//				and data_inicio <= NOW() and data_final >= NOW() order by a.data_inicio";				
$sql_result = mysql_query($sql);

echo "\n<table width='100%'>";
while($dados = mysql_fetch_object($sql_result)){
echo "\n<tr><td width='10'>";
echo "\n<td><b>Data do Exame:</b><input type='radio' name='codigo_turma' id='codigo_turma' value='".$dados->codigo."' checked><br><input type='text' name='data_final' value='' >";
echo "\n <a href='javascript:cal3.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calendário'></a>";
echo "\n		\n<script language='JavaScript'>\n";
echo "\n		<!-- \n";
echo "\n			var cal3 = new calendar1(document.f.data_final);\n";
echo "\n			cal3.year_scroll = true;\n";
echo "\n			//cal2.time_comp = true;\n";
echo "\n		//-->\n";
echo "\n		</script>\n";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exibir:";
echo "<input type='checkbox' name='exibe_dia' valeu='1' checked> Dia&nbsp;&nbsp;";
echo "<input type='checkbox' name='exibe_mes' valeu='1' checked> M&ecirc;s&nbsp;&nbsp;";
echo "<input type='checkbox' name='exibe_ano' valeu='1' checked> Ano";

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