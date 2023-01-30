<?php
mysql_connect("ciec-db","cieceja","S3nh@sb@nc0") or die('Erro na conexao');
mysql_select_db("cieceja") or die('Erro no banco');

$arquivo = md5(date("YmdHis")."wmsuplet_cnery");

$tok = array('cadastro_aluno','cadastro_cursos','cadastro_disciplinas','cadastro_escola',' cadastro_professor','certificados','matricula','periodos','professor_disciplina','turmas','docs','documentos','gabarito','permissoes');


	// set up basic connection
		$conn_id = ftp_connect("ciec-eja.com.br") or die('Erro no servidor');

		// login with username and password
		$login_result = ftp_login($conn_id, "cieceja", "mf6t1y76") or die('Erro na conexao');

		/* Liga modo passivo */
		ftp_pasv($conn_id, true);


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
	//echo $query."<br>";
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
					if(!is_dir("bancos")) mkdir("bancos");
					$com = "replace into ".$tabela." (".@implode(",",$fieldnames).") values ('".@implode("','",$D)."')";
					
					$arq = "bancos/".$arquivo."_".$d[id].".txt";

					if(file_put_contents($arq, $com)){



						$file = $arq;
						$remote_file = "/public_html/".$arq;

						// upload a file
						if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
						 echo "successfully uploaded $file<br>";
						 //mysql_query("update ".$tabela." set integracao = '1' where id = '".$d[id]."'");
						 unlink($arq);
						} else {
						 echo "There was a problem while uploading $file<br>";
						 unlink($arq);
						}


					}
					
			}
}

						// close the connection
						ftp_close($conn_id);

?>
