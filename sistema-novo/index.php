<?php
   @session_start();
   if($_GET['desligar']){
      echo "<center><br><br><br><h2>DERVIDOR DESDLIGADO!</h2></center>";
      shell_exec('sudo shutdown');
      file_put_contents('z.txt','dados');
      exit();
   }

   if($_GET['escola']) {
      $_SESSION['confUnidade'] = $_GET['escola'];
?>
      <script>window.location.href='./login/index.php?escola=<?=$_GET['escola']?>';</script>
<?php
   }else{
?>
      <script>window.location.href='../';</script>
<?php
   }
?>