<?php
@session_start();
//header('Content-Type: text/html; charset=utf-8');
@header("Content-Type: text/html; charset=iso-8859-1",true);
date_default_timezone_set('America/Manaus');


if(!$_SESSION['confUnidade']){
	echo "<script>window.location.href='http://{$_SERVER['SERVER_NAME']}:8087/'</script>";
	exit();
}

if($_SESSION['confUnidade']){
	include("../includes/dicionario_{$_SESSION['confUnidade']}.inc.php");
}

if($_GET['Dic']){
	$_SESSION['confUnidade'] = $_GET['Dic'];
	// echo "SESSOES: ".$_SESSION['confUnidade'];
}
/////////////////////////////////////////////////////////////////



//$Vetores = array($_POST, $_GET, $_SESSION, $_COOKIE);

$Vetores = array($_COOKIE, $_SESSION, $_GET, $_POST);

//for($i = 0; $i < count($Vetores); $i++){

foreach($Vetores as $x => $y){

	foreach($y as $k => $v){

	if(is_array($v)){

		foreach($v as $k1 => $v1){

			if(is_array($v1)){


				foreach($v1 as $k2 => $v2){
					@eval("\$$k2 = '".$v2."';");
				}

			}else{
				@eval("\$$k1 = '".$v1."';");
			}
		}
	}else{
		@eval("\$$k = '".$v."';");
	}
	}

}



?>