<?php

//echo $_SESSION['cook_logado']."<br>";
//echo $index."<br><br>"; 
if(!$_SESSION['cook_logado'] and !$index){
	  echo "<script>window.location.href='../login/index.php?index=index'</script>";
}


?>