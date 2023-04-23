<?php
   if($_GET['desligar']){
      echo "<center><br><br><br><h2>DERVIDOR DESDLIGADO!</h2></center>";
      shell_exec('sudo shutdown');
      file_put_contents('z.txt','dados');
      exit();
   }
?>
<!-- <script>window.location.href='./login/index.php';</script> -->
<script>window.location.href='./sistema-novo/?escola=cnery';</script>
