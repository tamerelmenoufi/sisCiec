<?php
@session_start();
//header('Content-Type: text/html; charset=utf-8');
@header("Content-Type: text/html; charset=iso-8859-1",true);
date_default_timezone_set('America/Manaus');

///////////////////DICIONÁRIOS////////////////////////////////
switch($_GET['escola']){
	case 'cnery':{
		setcookie("confUnidade",'cnery');
		break;
	}
	case 'leste':{
		setcookie("confUnidade",'lest');
		break;
	}
	case 'nacoes':{
		setcookie("confUnidade",'nacoes');
		break;
	}
	case 'sul':{
		setcookie("confUnidade",'sul');
		break;
	}
	default:{
		setcookie("confUnidade",false);
		break;
	}
}

echo "<br>Escola: ".$_GET['escola'];

if($_COOKIE['confUnidade']){
	include("../includes/dicionario_{$_COOKIE['confUnidade']}.inc.php");
}else{
	echo "<br>Cooke: ".$_COOKIE['confUnidade'];
	// echo "<script>window.location.href='http://{$_SERVER['SERVER_NAME']}:8087/sistema-novo/?sair=s'</script>";
	exit();
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
