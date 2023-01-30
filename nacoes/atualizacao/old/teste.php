<?php

$conf_qt = 100;

if(!$d1 and !$d2) { echo "<script>parent.location.href='iniciar.php'</script>"; exit; }

	 list($dia,$mes,$ano) = explode("-",$d1);
	 $d11 = "$ano-$mes-$dia 00:00:00";
	 
	 list($dia,$mes,$ano) = explode("-",$d2);
	 $d22 = "$ano-$mes-$dia 23:59:59";	 
	

$con_web = mysql_connect("184.107.129.18","wmsuplet_cnery","mf6t1y76") or die ("<center><h1>ERRO DE CONEXÃO com a Internet!</h1><br> <a href='./teste.php' target='_parent'>Tente novamente</a></center>");
mysql_select_db("wmsuplet_cnery",$con_web);

$tok = array('cadastro_aluno','cadastro_cursos','cadastro_disciplinas','cadastro_escola',' cadastro_professor','certificados','matricula','periodos','professor_disciplina','turmas','usuarios');

$dbname = 'wm';

if (!@mysql_connect('localhost', 'root', '')) {
    echo 'Could not connect to mysql';
    exit;
}

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

mysql_select_db($dbname);

$n_t = 0;
$n_a = (($_GET[n]) ? $_GET[n] : '0');

//Excluir todos os registros da eliminados no sistema
if($n_a == 0){
$apg = "select codigo,comando from logs where (data between '$d11' and '$d22') and operacao='delete' and atualizado != '1'";
$apg = mysql_query($apg);
while($ap = mysql_fetch_object($apg)){
set_time_limit(90);
mysql_query(str_replace("`","'",$ap->comando),$con_web);
mysql_query("update logs set atualizado='1' where codigo='".$ap->codigo."'");
//echo $ap->comando."<br>";
}
}
/////////////////////////////////////////////////////


while ($row = mysql_fetch_row($result)) {
   set_time_limit(9);
    if(in_array($row[0],$tok)){
      $tabela = $row[0];
	 
     $q = "select * from $tabela where (alteracao between '$d11' and '$d22') and  alteracao != '0000-00-00 00:00:00'";
	 //echo $q;
     $q =  mysql_query($q);
     $n_t = ((mysql_num_rows($q) > $n_t) ? mysql_num_rows($q) : $n_t) ;

     $q = "select * from $tabela where (alteracao between '$d11' and '$d22') and  alteracao != '0000-00-00 00:00:00' limit $n_a,$conf_qt";
     $q =  mysql_query($q);

     while($s = mysql_fetch_array($q)){
      set_time_limit(90);
       $dados[$tabela][]= $s;
     }      

   for($j=0;$j<count($dados[$tabela]);$j++){
      set_time_limit(90);
      $cn = mysql_num_fields($q);
      $campos = $valores = false;
      for($i=0;$i<$cn;$i++){ 
      set_time_limit(90);
      $campos[] = mysql_field_name($q,$i);
      $valores[] = $dados[$tabela][$j][$i];
      }
      $campos = @implode(",",$campos);
      $valores = @implode("','",$valores);
      $comando = "REPLACE INTO $tabela ($campos) VALUES ('".$valores."')";
     mysql_query($comando,$con_web);
     // echo $comando."<br>";

    }

    }
}

mysql_free_result($result);

mysql_close($con_web);


if($n_t > $n_a){
   

$pc = number_format($n_a*100/$n_t,0,false,false);

echo "<br><br><br><br><br><br><center><table cellspacing='0' cellpadding='0' width='500' height='75' bgcolor='#cccccc'>";
echo "<tr><td>&#32; Atualmente $pc% de sua atualiza&ccedil;&atilde;o no per&iacute;do de $d1 a $d2";
echo "<tr><td>";
echo "<table cellspacing='0' cellpadding='0' width='$pc%' height='25' bgcolor='green'><tr><td>&#32;</td></tr></table>";
echo "<tr><td>publicados $n_a de $n_t";
echo "</table>";


  // echo "<br><br><br><br><br><br><h1>($n_a de $n_t)AGUARDE ATUALIZACAO...</h1></center><br><br><br><br><br><br><br><br><br><br>";
   echo "<script>window.location.href='teste.php?n=".($n_a + $conf_qt)."&d1=$d1&d2=$d2'</script>";
}else{
echo "<br><br><br><br><br><br><center><h1>ATUALIZACAO CONCLUIDA!</h1><br>
     <a href='teste.php?n=".$_GET[n]."&d1=$d1&d2=$d2'>nova atualizacao</a>      
<br><br><br><br><br><br><br><br><br></center>";
}

?>