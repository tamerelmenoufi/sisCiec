<?php
	include("../includes/sessoes.inc.php");
	include("../includes/connect.inc.php");
        include("../includes/data_ext.inc.php");


function fullLower($str){
   // convert to entities
   $subject = htmlentities($str,ENT_QUOTES);
   $pattern = '/&([a-z])(uml|acute|circ';
   $pattern.= '|tilde|ring|elig|grave|slash|horn|cedil|th);/e';
   $replace = "'&'.strtolower('\\1').'\\2'.';'";
   $result = preg_replace($pattern, $replace, $subject);
   // convert from entities back to characters
   $htmltable = get_html_translation_table(HTML_ENTITIES);
   foreach($htmltable as $key => $value) {
      $result = ereg_replace(addslashes($value),$key,$result);
   }
   return(strtolower($result));
}



                $query = "select * from cadastro_escola where op='1'";
                $result = mysql_query($query);
                $d = mysql_fetch_object($result);

                list($dia,$mes,$ano) = explode("-",$_GET[d1]);
                list($dia1,$mes1,$ano1) = explode("-",$_GET[d2]);

                switch($mes){

                      case '01':{
                           $mesr = " de Janeiro ";
                           break; 
                      }
                      case '02':{
                           $mesr = " de Fevereiro ";
                           break; 
                      }
                      case '03':{
                           $mesr = " de Mar&ccedil;o ";
                           break; 
                      }
                      case '04':{
                           $mesr = " de Abril ";
                           break; 
                      }
                      case '05':{
                           $mesr = " de Maio ";
                           break; 
                      }
                      case '06':{
                           $mesr = " de Junho ";
                           break; 
                      }
                      case '07':{
                           $mesr = " de Julho ";
                           break; 
                      }
                      case '08':{
                           $mesr = " de Agosto ";
                           break; 
                      }
                      case '09':{
                           $mesr = " de Setembro ";
                           break; 
                      }
                      case '10':{
                           $mesr = " de Outubro ";
                           break; 
                      }
                      case '11':{
                           $mesr = " de Novembro ";
                           break; 
                      }
                      case '12':{
                           $mesr = " de Dezembro ";
                           break; 
                      }


               }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RELA&Ccedil;&Atilde;O DE ALUNOS CONCLUENTES</title>

<style>
   body { 
       font-family:Calibri;
       font-size:7.5px; 
       line-height:8px;

   }

   .nomes{
     /*text-transform:lowercase;*/
   }



      <?php
        $l = 9.5;
        $a = 13;
      ?>
    

   .medidas { 
      border:1px solid #fff;
      width:<?=$l?>cm;
      height:<?=$a?>cm;
      overflow: hidden;
      position: absolute;
      top:0cm;
      left:0cm;
    }

   .col1 { 
      width: 100%;
      height:<?=($a)?>cm;
      border-right: solid 1px #fff;
      font-family: arial;
      font-size: 7.5px;
      float: left;
      padding-right: 5px;
      padding-left: 5px;
      text-align: justify;
      position: relative;
      left: 0px;
    }

  .fonte{
    font-size: 7.5px;
  }

</style>

</head>

<body>


  <?php
    $tit[] = "<center>".utf8_encode($d->descricao)."<b>EDUCA&Ccedil;&Atilde;O DE JOVENS E ADULTOS – EJA</b><br>";
    $tit[] = "<b>Rela&ccedil;&atilde;o de Alunos Concludentes do Ensino Médio, na Modalidade Educa&ccedil;&atilde;o de Jovens e Adultos–EJA, Com Certificados Registrados no M&ecirc;s ".$mesr." de ".$ano.".</b></center>";



    // aqui entra a relação dos alunos aprovados
  $query = "select a.*,b.nome,c.descricao from certificados a left join cadastro_aluno b on a.codigo_aluno = b.codigo left join cadastro_cursos c on a.codigo_curso=c.codigo where (a.data between '$ano-$mes-$dia' and '$ano1-$mes1-$dia1') and c.descricao='$curso' order by b.nome"; //group by b.codigo 
  $result = mysql_query($query);
  $i = 1;
  while($d = mysql_fetch_object($result)){
    $nomes[] = strtolower(htmlentities($d->nome));
  }
  ?>
    <div class="medidas">
      <div class="col1"><?=utf8_encode(@implode(false,$tit)).ucwords(utf8_encode(@implode("; ",$nomes))).'.'?></div>
    </div>




</body>
</html>