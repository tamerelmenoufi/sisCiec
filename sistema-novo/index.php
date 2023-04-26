<?php
   @session_start();
   if($_GET['desligar']){
      echo "<center><br><br><br><h2>DERVIDOR DESDLIGADO!</h2></center>";
      shell_exec('sudo shutdown');
      file_put_contents('z.txt','dados');
      exit();
   }

///////////////////DICIONÁRIOS////////////////////////////////
switch($_GET['escola']){
	case 'cnery':{
		$_SESSION['confUnidade'] = 'cnery';
		// setcookie("confUnidade",'cnery');
		break;
	}
	case 'leste':{
		$_SESSION['confUnidade'] = 'leste';
		// setcookie("confUnidade",'lest');
		break;
	}
	case 'nacoes':{
		$_SESSION['confUnidade'] = 'nacoes';
		// setcookie("confUnidade",'nacoes');
		break;
	}
	case 'sul':{
		$_SESSION['confUnidade'] = 'sul';
		// setcookie("confUnidade",'sul');
		break;
	}
}



   if($_SESSION['confUnidade']) {
?>
      <script>window.location.href='./login/index.php?escola=<?=$_GET['escola']?>';</script>
<?php
   }else{
?>
      <script>window.location.href='../';</script>
<?php
   }
?>