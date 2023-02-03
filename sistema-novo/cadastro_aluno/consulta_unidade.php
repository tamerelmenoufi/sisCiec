<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/funcoes_js.inc.php");
include("../includes/connect.inc.php");
//mysql_connect("localhost","wmsuplet","mf6t1y76") or die('erro connect');
mysql_select_db("wmsuplet_".$_GET[unidade]) or die('erro banco:'.$_GET[unidade]);

if($_GET[nome]){ 
	$nome = trim($_GET[nome]);
	$nome = "'%".str_replace(" ","%' or nome like '%",$nome)."%'";
	$complemento .= " and (nome like ".$nome.") ";
}
if($_GET[pai]){
	$nome_pai = trim($_GET[pai]);
	$nome_pai = "'%".str_replace(" ","%' or nome_pai like '%",$nome_pai)."%'";
	$complemento .= " and (nome_pai like ".$nome_pai.") ";
}
if($_GET[mae]){
	$nome_mae = trim($_GET[mae]);
	$nome_mae = "'%".str_replace(" ","%' or nome_mae like '%",$nome_mae)."%'";
	$complemento .= " and (nome_mae like ".$nome_mae.") ";
}
if($_GET[rg]){
	$rg = trim($_GET[rg]);
	$complemento .= " and rg = '$rg' ";
}
if($_GET[cpf]){
	$cpf = trim($_GET[cpf]);
	$complemento .= " and cpf = '$cpf' ";
}


//novo
$query1  = " select ";
$query1 .= "cadastro_aluno.codigo,";
$query1 .= "cadastro_aluno.cci,";
$query1 .= "cadastro_aluno.nome, ";
$query1 .= "cadastro_aluno.cpf, ";
$query1 .= "cadastro_aluno.rg, ";
$query1 .= "cadastro_aluno.telefone, ";
$query1 .= "cadastro_aluno.email";
$query1 .= " from cadastro_aluno";
$query1 .= " where 1=1 ".$complemento;

$result1 = mysql_query($query1);
$totreg = mysql_num_rows($result1);
$query = $query1;
$result = mysql_query($query);
$totreg_01 = mysql_num_rows($result);

//echo $query;

echo "<table width='100%' border='0' cellpadding='0' cellspacing='10'>";
echo "<tr><td height='332' valign='top'>UNIDADE (".$_GET[unidade].")";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "  <tr>";
echo "    <td colspan='5' class='titulos_modelos'>".$_GET[nome];
echo "         <td  align='right'>&nbsp;";

echo "</table>";

if ($totreg){	
echo "<table width='100%'  border='0' cellpadding='0' cellspacing='0' class='borda_tabela'>";
echo "<td align='left' valign='top'>";
echo "<table width='100%' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr class='titulo_tabelas'>";
echo "<td>Matr&iacute;cula";
echo "<td>CCI";
echo "<td>Nome";
echo "<td>CPF";
echo "<td>RG";
echo "<td>Telefone";
echo "<td>Email";
echo "<td width='35'>A&ccedil;&atilde;o";
echo "</tr>";
}
$cnt = 0;
while (list(
                 $codigo,
				 $cci,
                 $nome,
                 $cpf,
                 $rg,
                 $telefone,
                 $email
                ) = mysql_fetch_row($result)){ $contador ++;
if($cnt%2 == 0){ echo "<tr class='tr_linha1'>"; }else{echo "<tr class='tr_linha2'>";}  $cnt++;
echo "<td class='titulo_f'>".matr($codigo);
echo "<td class='titulo_f'>$cci";
echo "<td class='titulo_f'>$nome";
echo "<td class='titulo_f'>$cpf";
echo "<td class='titulo_f'>$rg";
echo "<td class='titulo_f'>$telefone";
echo "<td class='titulo_f'>$email";
echo "<td width='35'>";
echo "<a href='consulta_unidade.php?unidade=" .$_GET[unidade]. "&nome=" .$_GET[nome]. "&pai=" .$_GET[pai]."&mae=" .$_GET[mae]. "&rg=" .$_GET[rg]. "&cpf=" .$_GET[cpf]."&cod=$codigo'>Editar</a>";
echo "</td>";

$cod = $codigo;

  } $reg_final = $param + $contador;
if ($totreg){	
echo "</table>";
echo "</td>";
echo "</table>";
 }
echo "  </table>";













if(!$_GET[cod]) exit();


$sql = "select a.*,b.nome,c.codigo as cod_mat,c.nota,c.carga_horaria,c.frequencia,c.situacao,c.codigo_escola as codEscola, c.data_exame as dataexame, concat(d.descricao,' ',c.observacao) as disc,concat(e.descricao,' (',e.tipo,')') as disc_curso,f.descricao as escola from turmas a 
        left join cadastro_professor b on a.codigo_professor = b.codigo
		left join matricula c on a.codigo_curso=c.codigo_curso and a.codigo_disciplina=c.codigo_disciplina and a.codigo=c.codigo_turma
		left join cadastro_disciplinas d on a.codigo_curso=d.codigo_curso and a.codigo_disciplina=d.codigo
		left join cadastro_cursos e on a.codigo_curso=e.codigo 
		left join cadastro_escola f on c.codigo_escola=f.codigo
		where c.codigo_aluno='$cod' order by e.descricao,d.descricao,a.data_inicio desc,a.codigo";
//$sql_result = mysql_query($sql);
//echo $sql;
$result1 = mysql_query($sql);
$totreg = mysql_num_rows($result1);
$query = $sql; //." limit $param,$maxpag";
$result = mysql_query($query);
$totreg_01 = mysql_num_rows($result);



//echo $query;

echo "\n<br><br><table bgcolor='#ffffff' bordercolor='#ffffff' width='100%'>";
if(mysql_num_rows($result)){

$cnt = 0;
while($dados = mysql_fetch_object($result)){ $contador ++;
//echo "\n<tr><td><input type='radio' name='codigo_turma' id='codigo_turma' value'".$dados->codigo."'>";

echo "\n<tr bgcolor='#cccccc'>";
//echo $dados->cod_mat;
echo "\n<td colspan='12'><b>Escola</b>";

echo "\n<tr bgcolor='#eeeeee'>";
echo "\n<td colspan='12'>".$dados->escola;


echo "\n<tr bgcolor='#cccccc'>";
echo "\n<td colspan='3'><b>Curso</b>";
echo "\n<td colspan='2'><b>Disciplina</b>";
echo "\n<td><b>C.H.</b>";
echo "\n<td colspan='4'><b>Professor</b>";
echo "\n<td align='center'>&nbsp;";

list($vin) = mysql_fetch_row(mysql_query("select codigo_matricula from matricula where codigo='$dados->cod_mat'"));
if($vin){
	echo "<input type='button' value='VINC' onclick=\"javascript:desvincular('$dados->cod_mat')\">";
	}
	//echo "<input type='button' value='VINC' onclick=\"javascript:desvincular('$dados->cod_mat')\">";


echo "\n<td>&nbsp;";


echo "\n<tr bgcolor='#eeeeee'>";
echo "\n<td colspan='3'>".$dados->disc_curso;
echo "\n<td colspan='2'>".$dados->disc."(".$dados->codigo.") ";
echo "\n<td>".$dados->carga_horaria;
echo "\n<td colspan='4'>".(($dados->codEscola == $conf[codigo_curso]) ? $dados->nome : '-------------');

echo "\n<td>".(($dados->codEscola == $conf[codigo_curso]) ? "&nbsp;" : '-------------');
echo "\n<td>&nbsp;";

echo "\n<tr bgcolor='#cccccc'>";
echo "\n<td><b>Turno</b>";
echo "\n<td><b>In&iacute;cio</b>";
echo "\n<td><b>Final</b>";
echo "\n<td><b>Entada</b>";
echo "\n<td><b>Sa&iacute;da</b>";
echo "\n<td><b>Exame</b>";
echo "\n<td><b>Nota</b>";
echo "\n<td><b>Freq.</b>";
echo "\n<td>&nbsp;";
echo "\n<td><b>Situa&ccedil;&atilde;o:</b>";
echo "\n<td>&nbsp;";
echo "\n<td>&nbsp;";



echo "\n<tr bgcolor='#eeeeee'>";

if($dados->codEscola == $conf[codigo_curso]){
echo "\n<td>".$dados->turno;
echo "\n<td>".data_formata($dados->data_inicio);
echo "\n<td>".data_formata($dados->data_final);
echo "\n<td>".$dados->hora_inicio;
echo "\n<td>".$dados->hora_final;
echo "\n<td>".data_formata($dados->data_exame);
echo "\n<td>".number_format($dados->nota,1,',',false);
echo "\n<td>".(($dados->frequencia>0)?$dados->frequencia:"&nbsp;");
echo "\n<td>"; //.$dados->situacao;
echo "\n<td>"; //.$dados->situacao;

echo "\n$dados->situacao";

}else{

echo "\n<td>---------------";
echo "\n<td>---------------";
echo "\n<td>---------------";
echo "\n<td>---------------";
echo "\n<td>---------------";
echo "\n<td>".data_formata($dados->dataexame);
echo "\n<td>".number_format($dados->nota,1,',',false);
echo "\n<td>".(($dados->frequencia>0)?$dados->frequencia:"&nbsp;");
echo "\n<td>"; //.$dados->situacao;
echo "\n<td>"; //.$dados->situacao;

echo "\n$dados->situacao";

}



echo "\n<td>&nbsp;";
echo "\n<td>&nbsp;";


echo "\n<tr bgcolor='#000000'><td colspan='12' height='2' bgcolor='#000000'>";

}$reg_final = $param + $contador;
}

echo "\n</table>";

echo "\n     </table>";

?>
