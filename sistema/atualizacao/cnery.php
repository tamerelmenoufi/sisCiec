<html>
<head></head>
<body>
<?php

$online = @mysql_connect("ciec-eja.com.br","repl","S3nh@sr3p!2020#")or die('Erro no banco de dados online');

mysql_connect("ciec-db","root","S3nh@sb@nc0") or die('Erro na conexao');
mysql_select_db("cieceja") or die('Erro no banco');


$query = "select * from `update` order by id";
$result = mysql_query($query);
while($d = mysql_fetch_object($result)){
	
	set_time_limit(100);

	$colunas = mysql_query("SHOW COLUMNS FROM ".$d->tabela);

	$fieldnames=array(); 
	if (mysql_num_rows($colunas) > 0) { 
		while ($row = mysql_fetch_assoc($colunas)) { 
		  $fieldnames[] = $row['Field']; 
		} 
	} 

	if($d->operacao != 'DELETE'){
		$q = "select * from ".$d->tabela." where id = '".$d->codigo."'";
		//echo $q."<br>";
		$r = mysql_query($q);
		$d1 = mysql_fetch_array($r);


		
		$xn = count($d1);
		$xn = ($xn/2);
		$D = array();
		for($i=0;$i<$xn;$i++){
			if(($xn-1) == $i){
			$D[] = '1';
			}else{
			$D[] = trim(str_replace("'","`",$d1[$i]));
			}
		}

		$com = "replace into cieceja_cnery.".$d->tabela." (".@implode(",",$fieldnames).") values ('".@implode("','",$D)."')";

	}else{
		$com = "delete from cieceja_cnery.".$d->tabela." where codigo = '".$d->codigo."'";
	}

	echo $com."<br>";

	if(mysql_query($com,$online)){
		//mysql_query("delete from `update` where id = '".$d->id."'");
		echo "Atualização ok<br>";
	}elseif(!$vt){
                                     //mysql_query("delete from `update` where id = '".$d->id."'");
                                    echo "Ocorreu algum erro<br>";
               }else{
		echo "Ocorreu algum erro<br>";
	}

}

?>
</body>
</html>
