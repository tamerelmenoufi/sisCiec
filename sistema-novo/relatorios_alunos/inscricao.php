<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/connect.inc.php");

include("../includes/config.inc.php");
?>
<link rel="stylesheet" href="<?=$servidor_url?>/menu_java/template_css.css" type="text/css" /> <!-- rtl change -->
<link rel="stylesheet" href="<?=$servidor_url?>/menu_java/theme.css" type="text/css" />

<script language='javascript'>
   function imprimir_comprovante(val){
      var w = window.open("./cartao.php?cod=" + val,"cartao");
	  w.focus();
	  return false;
   }

   function imprimir_declaracao(val){
      var w = window.open("./declaracao.php?cod=" + val,"declaracao");
	  w.focus();
	  return false;
   }

</script>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table border='0'  cellpadding='0' cellspacing='0' width='100%'><tr><td width='18%' class='font_branca'>RELAT�RIOS</td><td width='90%'></td><tr><td colspan='2'  class='bg_busca_aluno' height='50'>&nbsp;&nbsp;COMPROVANTE DE MATR�CULA</td></table>
<?php

echo $sql = "select a.*,b.nome,c.codigo as cod_mat,c.nota,c.frequencia,c.situacao,concat(d.descricao,' ',c.observacao) as disc,concat(e.descricao,' (',e.tipo,')') as disc_curso from turmas a
        left join cadastro_professor b on a.codigo_professor = b.codigo
		left join matricula c on a.codigo_curso=c.codigo_curso and a.codigo_disciplina=c.codigo_disciplina and a.codigo=c.codigo_turma
		left join cadastro_disciplinas d on a.codigo_curso=d.codigo_curso and a.codigo_disciplina=d.codigo
		left join cadastro_cursos e on a.codigo_curso=e.codigo
				where c.codigo_aluno='$cod' and c.codigo_escola = '$conf[codigo_curso]' order by a.data_inicio desc,a.codigo";
$sql_result = mysql_query($sql);


//echo $sql;

echo '<div align="justify" style="width:100%; height:130px; overflow: auto; padding:0px; font-size:12px; line-height:20px;">';

echo "<table bgcolor='#ffffff' bordercolor='#ffffff' width='100%' cellspacing='0'>";
if(mysql_num_rows($sql_result)){

}

while($dados = mysql_fetch_object($sql_result)){
//echo "<tr><td><input type='radio' name='codigo_turma' id='codigo_turma' value'".$dados->codigo."'>";

echo "<tr bgcolor='#cccccc'>";
echo "<td colspan='3'><b>Curso</b>";
echo "<td colspan='2'><b>Disciplina</b>";
echo "<td colspan='4'><b>Professor</b>";
echo "<td>&nbsp;";


echo "<tr bgcolor='#eeeeee'>";
echo "<td colspan='3'>".$dados->disc_curso;
echo "<td colspan='2'>".$dados->disc;
echo "<td colspan='4'>".$dados->nome;

echo "<td><input type='image' src='../img/5.gif' title='Imprimir comprovante de Matr�cula' onclick=\"return imprimir_comprovante('$dados->cod_mat');\">";

echo "<tr bgcolor='#cccccc'>";
echo "<td><b>Turno</b>";
echo "<td><b>In�cio</b>";
echo "<td><b>Final</b>";
echo "<td><b>Entada</b>";
echo "<td><b>Sa�da</b>";
echo "<td><b>Exame</b>";
echo "<td><b>Nota</b>";
echo "<td><b>Freq.</b>";
echo "<td><b>Situa��o:</b>";
echo "<td>&nbsp;";



echo "<tr bgcolor='#eeeeee'>";

echo "<td>".$dados->turno;
echo "<td>".data_formata($dados->data_inicio);
echo "<td>".data_formata($dados->data_final);
echo "<td>".$dados->hora_inicio;
echo "<td>".$dados->hora_final;
echo "<td>".data_formata($dados->data_exame);
echo "<td>".number_format($dados->nota,2,",",false);
echo "<td>".$dados->frequencia;
echo "<td>".$dados->situacao;

echo "<td>"; //<input type='image' src='../img/6.gif' title='Imprimir declara��o de Matr�cula' onclick=\"return imprimir_declaracao('$dados->cod_mat');\">";

echo "<tr bgcolor='#000000'><td colspan='10' height='2' bgcolor='#000000'>";

}
echo "<a name='fim'></a>";
echo "</table>";
ECHO "</div>";

?>