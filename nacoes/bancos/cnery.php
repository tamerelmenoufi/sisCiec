<html>
<head>
<script>

function retorno(){
	window.location.href='cnery.php';
}

</script>
</head>

<?php

$online = mysql_connect("ciec-eja.com.br","cieceja","mf6t1y76");

mysql_connect("ciec-db","cieceja","S3nh@sb@nc0") or die('Erro na conexao');
mysql_select_db("cieceja") or die('Erro no banco');



$arquivo = md5(date("YmdHis")."wmsuplet_cnery");

$tok = array('cadastro_aluno','cadastro_cursos','cadastro_disciplinas','cadastro_escola',' cadastro_professor','certificados','matricula','periodos','professor_disciplina','turmas','docs','documentos','gabarito','permissoes');


for($j=0;$j<count($tok);$j++){

	$tabela = $tok[$j];

	$result = mysql_query("SHOW COLUMNS FROM ".$tabela);

	$fieldnames=array(); 
	if (mysql_num_rows($result) > 0) { 
	while ($row = mysql_fetch_assoc($result)) { 
	  $fieldnames[] = $row['Field']; 
	} 
	} 

	$query = "select * from ".$tabela." where integracao = '2' limit 0,2";

		$result = mysql_query($query);
		while($d = mysql_fetch_array($result)){
			set_time_limit(100);
			$xn = count($d);
			$xn = ($xn/2);
			$D = array();
			for($i=0;$i<$xn;$i++){
				if(($xn-1) == $i){
				$D[] = '1';
				}else{
				$D[] = trim(str_replace("'","`",$d[$i]));
				}
			}
				
				$com = "replace into cieceja_cnery.".$tabela." (".@implode(",",$fieldnames).") values ('".@implode("','",$D)."')";

				if(mysql_query($com,$online)){
					mysql_query("update ".$tabela." set integracao = '1' where id = '".$d[id]."'");
					echo "Update - ".date("d/m/Y H:i:s")."<br>";

				}else{
					echo "Error - ".date("d/m/Y H:i:s")."<br>";

				}


		}
}

?>

<body onload="retorno()"></body>
</html>