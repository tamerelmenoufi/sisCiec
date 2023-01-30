<?php
session_start();
date_default_timezone_set('America/Manaus');

mysql_connect("ciec-db","root","S3nh@sb@nc0") or die("Erro na conexão ".mysql_error());
mysql_select_db( "cieceja_nacoes" ) or die("Erro no banco ".mysql_error());
 

mysql_query("SET GLOBAL sql_mode = ''");

function diasemana($data) {
	$ano =  substr("$data", 0, 4);
	$mes =  substr("$data", 5, -3);
	$dia =  substr("$data", 8, 9);

	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

	switch($diasemana) {
		case"0": $diasemana = "dom"; break;
		case"1": $diasemana = "seg"; break;
		case"2": $diasemana = "ter"; break;
		case"3": $diasemana = "qua"; break;
		case"4": $diasemana = "qui"; break;
		case"5": $diasemana = "sex"; break;
		case"6": $diasemana = "sab"; break;
	}

	return $diasemana;
}
 
   
   $query = "select * from usuarios where login='".$_POST['login']."' and senha='".$_POST['senha']."'";
   $result = mysql_query($query);
   if(mysql_num_rows($result)){
   	$d = mysql_fetch_object($result);
      
	  $dias = explode("|",$d->dias);
	  $horas = explode("|",$d->horarios);
	  $horas1 = explode(":",$horas[0]);
	  $horas2 = explode(":",$horas[1]);

	  $hi = mktime($horas1[0],$horas1[1],0,date("m"),date("d"),date("Y"));
	  $hf = mktime($horas2[0],$horas2[1],0,date("m"),date("d"),date("Y"));
	  $nw = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
	  
	  //echo "!".in_array(diasemana(date('Y-m-d')),$dias)." and (($hi > $nw) or ($nw > $hf))<br>";
	  
	  //echo $d->dias."<br>".$d->horarios;
	  
	  //echo "<br>".date("d-m-Y H:i:s",$hi)." - ".date("d-m-Y H:i:s",$hf)." : ".date("d-m-Y H:i:s",$nw);
	  
	  
	 //!in_array(diasemana(date("Y-m-d")),$dias) and (($hi<=$nw) or ($nw<=$hf))

//*
	 
	  if( !in_array(diasemana(date("Y-m-d")),$dias) ){
		  echo "<script>alert('Usuario sem autorizacao');</script>";
		  echo "<script>window.location.href='./index.php';</script>";
		  exit();
	  }
	  if( !($hi <= $nw) ){
		  echo "<script>alert('Usuario sem autorizacao');</script>";
		  echo "<script>window.location.href='./index.php';</script>";
		  exit();
	  }
	  if( !($nw <= $hf) ){
		  echo "<script>alert('Usuario sem autorizacao');</script>";
		  echo "<script>window.location.href='./index.php';</script>";
		  exit();
	  }
	  
	  
//*/	  
	  
	  //exit();
	  
	  
	  
	  $_SESSION['cook_logado'] = $d->codigo;
	  $_SESSION['index'] = "xindex";
	  $_SESSION['cook_perfil'] = $d->perfil;
	  $_SESSION['cook_banco'] = $d->banco;
	  
	  echo "<script>window.location.href='../principal/index.php'</script>";
   }else{
     echo "<script>window.location.href='./index.php'</script>";
   }

?>
