<?php

include("sessoes.inc.php");


mysql_connect("ciec-db","root","S3nh@sb@nc0") or die("Erro na conexção ".mysql_error());
mysql_select_db( "cieceja_".$_SESSION['Dic'] ) or die("Erro no banco ".mysql_error());


//mysql_connect("ciec-db","cieceja","S3nh@sb@nc0");
//mysql_select_db( $_SESSION['cook_banco'] );


//echo "<BR><BR><BR>BANCO DA HORA:".$_SESSION['cook_banco']."<BR><BR><BR>";

$conf[resolucao]='Lei Federal n. 9394/96, de 20 de dezembro de 1996.<br>';
$conf[r]='Lei Federal n. 9394/96, de 20 de dezembro de 1996.';

$conf[unidade] = $Dicionario['unidade'];
echo $Dicionario['unidade'];


list($conf[codigo_curso],$conf[unidade]) = mysql_fetch_row(mysql_query("select codigo, descricao from cadastro_escola where op='1'"));


$AtualizaCod = array(	"cadastro_aluno",
						"cadastro_cursos",
						"cadastro_disciplinas",
						"cadastro_escola",
						"cadastro_professor",
						"certificados",
						"docs",
						"documentos",
						"gabarito",
						"logs",
						"matricula",
						"periodos",
						"permissoes",
						"professor_disciplina",
						"turmas",
						"usuarios"
					);


for($i=0;$i<count($AtualizaCod);$i++){
	mysql_query("update ".$AtualizaCod[$i]." set codigo = concat('".$conf[Unidade]."',id) where codigo = ''");
}


include("../includes/funcoes_php.inc.php");




?>
