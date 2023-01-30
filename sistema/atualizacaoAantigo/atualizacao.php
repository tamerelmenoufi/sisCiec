<?php
include("../includes/sessoes.inc.php");
include("../includes/form_busca.inc.php");
include("../includes/estilos.inc.php");

	@mysql_connect("189.113.6.170","wmsuplet_cnery","mf6t1y76") or die ("<center><h1>ERRO DE CONEX�O com a Internet!</h1><br> <a href='../atualizacao/iniciar.php' target='_parent'>Tente novamente</a></center>");

include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");
include("../includes/connect.inc.php");


                        $qtpp = 10;


			
			$query = "select * from logs where atualizado = '0'";
                        $result = mysql_query($query);
                        $todos = mysql_num_rows($result);


			$query = "select * from logs where atualizado = '0' limit ".$qtpp;

                        if($todos > $qtpp){ $recarrega = true; }else{ $recarrega = false; }
			//echo $query;
			$result = mysql_query($query);
			while($d = mysql_fetch_object($result)){
			


	             if($d->operacao == 'insert'){


                                $v = explode("set",$d->comando);

				if(count($v) == 2){
				$d->comando = trim($v[0])." set codigo=`".$d->registro."`, ". (($d->tabela != 'matricula') ? substr(trim($v[1]),0,-1)."'" : trim($v[1]));

                                }else{
				$t = explode("(",$d->comando);
				
				$d->comando = trim($t[0]).' ( codigo, '. trim($t[1])." ( `".$d->registro."`, ".trim($t[2]).trim($t[3]).trim($t[4]).trim($t[5]).trim($t[6]).trim($t[7]);

                                $d->comando = str_replace("replace`","replace('",$d->comando);


                                }
				
			}elseif($d->operacao == 'update'){

				$d->comando = substr(trim($d->comando),0,-1)."'";

                        }elseif($d->operacao == 'delete'){

                              $d->comando = substr(trim($d->comando),0,-1)."'";

                        }

		
        $comando = str_replace("`,`","','",$d->comando);

        $comando = str_replace("` ,`","','",$comando);

        $comando = str_replace("`, `","','",$comando);

        $comando = str_replace("` , `","','",$comando);

        $comando = str_replace("(`","('",$comando);

        $comando = str_replace("( `","('",$comando);

        $comando = str_replace("`)","')",$comando);


        $comando = str_replace("=`","='",$comando);
        $comando = str_replace("= `","='",$comando);

        $comando = str_replace("`,","',",$comando);


       $comando = str_replace(",`",",'",$comando);
       $comando = str_replace(", `",",'",$comando);

       $comando = str_replace('` where',"' where",$comando);

	   $ultimo_comando = substr($comando,-1);
	   
	   if($ultimo_comando == '`'){
	   	$comando = substr($comando,0,-1)."'";
	   }


        $sql[] = str_replace("` )","')",$comando);

        $sql_cod[] = $d->codigo;
	
	}
	
	
	mysql_connect("bm22.webservidor.net","wmsuplet_cnery","mf6t1y76");
	mysql_select_db("cieceja");

	for ($i=0; $i<count($sql);$i++){

		if(mysql_query($sql[$i])){
                   $sql_ok[] = $sql_cod[$i];
                   echo "<p># Registro-ok: ".($i+1)."<br>".$sql[$i]."</p>";
                }else{
		   $sql_ok[] = $sql_cod[$i];
		   echo "<p># Registro-falhou: ".($i+1)."<br>".$sql[$i]."</p>"; 
                }
	}



mysql_connect("127.0.0.1","root","");
mysql_select_db("wm");


	for ($i=0; $i<count($sql_ok);$i++){

	  $query_log = "update logs set atualizado = '1' where codigo='$sql_ok[$i]'";
	  echo $query_log."<br><br>";
	  $result_log = mysql_query($query_log);
	
	}



        if($recarrega){
        echo "<script>parent.location.href='iniciar.php'</script>";
        }else{
        echo "<script>parent.location.href='concluido.php'</script>";
        }


include("../includes/rodape.inc.php");
?>