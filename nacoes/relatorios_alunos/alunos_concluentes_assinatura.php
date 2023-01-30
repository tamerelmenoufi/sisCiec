<?php
	include("../includes/sessoes.inc.php");
	include("../includes/connect.inc.php");

                $query = "select * from cadastro_escola where op='1'";
                $result = mysql_query($query);
                $d = mysql_fetch_object($result);

                list($dia,$mes,$ano) = explode("-",$_GET[d1]);
                list($dia1,$mes1,$ano1) = explode("-",$_GET[d2]);

                switch($mes){

                      case '01':{
                           $mesr = " DE JANEIRO ";
                           break; 
                      }
                      case '02':{
                           $mesr = " DE FEVEREIRO ";
                           break; 
                      }
                      case '03':{
                           $mesr = " DE MAR&Ccedil;O ";
                           break; 
                      }
                      case '04':{
                           $mesr = " DE ABRIL ";
                           break; 
                      }
                      case '05':{
                           $mesr = " DE MAIO ";
                           break; 
                      }
                      case '06':{
                           $mesr = " DE JUNHO ";
                           break; 
                      }
                      case '07':{
                           $mesr = " DE JULHO ";
                           break; 
                      }
                      case '08':{
                           $mesr = " DE AGOSTO ";
                           break; 
                      }
                      case '09':{
                           $mesr = " DE SETEMBRO ";
                           break; 
                      }
                      case '10':{
                           $mesr = " DE OUTUBRO ";
                           break; 
                      }
                      case '11':{
                           $mesr = " DE NOVEMBRO ";
                           break; 
                      }
                      case '12':{
                           $mesr = " DE DEZEMBRO ";
                           break; 
                      }


               }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8959-1" />
<title>RELA&Ccedil;&Atilde;O DE ALUNOS CONCLUENTES</title>
</head>

<body>
<table width="100%" border="1" cellspacing="0" cellpadding="2">
  <tr align="center" valign="middle">
    <td colspan="4"><?=$d->descricao?></td>
  </tr>
  <tr align="center" valign="middle">
    <td colspan="4">RELA&Ccedil;&Atilde;O <?=$mesr?> - <?=$ano?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">No</td>
    <td align="center" valign="middle">RELA&Ccedil;&Atilde;O DE ALUNOS CONCLUENTES</td>
    <td align="center" valign="middle">DATA</td>
    <td align="center" valign="middle">ASSINATURA</td>
  </tr>
  <?php
  	// aqui entra a relação dos alunos aprovados
	$query = "select a.*,b.nome,c.descricao from certificados a left join cadastro_aluno b on a.codigo_aluno = b.codigo left join cadastro_cursos c on a.codigo_curso=c.codigo where (a.data between '$ano-$mes-$dia' and '$ano1-$mes1-$dia1') and c.descricao='$curso' order by b.nome"; //group by b.codigo 
	$result = mysql_query($query);
	$i = 1;
	while($d = mysql_fetch_object($result)){
	  $descricao = explode(" ",$d->descricao);
	  $I1 = substr(trim($descricao[0]),0,1);
	  $I2 = substr(trim($descricao[1]),0,1);
	  $I = strtoupper($I1.$I2);
	  //data
	  $data = explode("-",$d->data);
	  $d->data = $data[2].'/'.$data[1].'/'.$data[0];
  ?>
  <tr>
    <td align="center" valign="middle">&nbsp;<?=$i?></td>
    <td align="left" valign="middle">&nbsp;<?=($d->nome)?></td>
    <td align="center" valign="middle" width='100'>&nbsp; </td>
    <td width="50%" align="center" valign="middle">&nbsp;</td>
  </tr>
  <?php
  	$i++;
  }
  ?>
</table>
</body>
</html>
