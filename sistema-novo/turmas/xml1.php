<?php
require_once("../includes/connect.inc.php"); 
/******************************************************************
// ARQUIVO ...: Monta o XML das Cidades 
// BY ........: Tamer Mohamed Elmenoufi     
// DATA ......: 17/12/2006              
/******************************************************************/

//CONECTA AO MYSQL                     
          


//RECEBE PAR�METRO                     
$curso = $_POST["curso"]; 
//$curso = 11;

//QUERY  
$sql = " 
       SELECT a.codigo, a.descricao    
        FROM  cadastro_disciplinas a                    
		where a.codigo_curso = '".$curso."'
		ORDER BY a.descricao";            

/*
$arq = 'sql.txt';
$abre = fopen($arq,"w");
fwrite($abre,$sql,8640000);
fclose($abre);
*/

//EXECUTA A QUERY               
$sql = mysql_query($sql);       

$row = mysql_num_rows($sql);    

//VERIFICA SE VOLTOU ALGO 
if($row) {                
   //XML
   $xml  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
   $xml .= "<dados>\n";               
   
   //PERCORRE ARRAY            
   for($i=0; $i<$row; $i++) {  
      $codigo    = mysql_result($sql, $i, "codigo"); 
	  $descricao = mysql_result($sql, $i, "descricao");
      $xml .= "<disciplinas>\n";     
      $xml .= "<codigo>".$codigo."</codigo>\n";                  
      $xml .= "<descricao>".$descricao."</descricao>\n";         
      $xml .= "</disciplinas>\n";    
   }//FECHA FOR                 
   
   $xml.= "</dados>\n";
   
   //CABE�ALHO
   Header("Content-type: application/xml; charset=iso-8859-1"); 
}//FECHA IF (row)                                               

//PRINTA O RESULTADO  
echo $xml;            
?>
