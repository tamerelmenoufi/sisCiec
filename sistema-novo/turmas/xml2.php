<?php
require_once("../includes/connect.inc.php");   
/******************************************************************
// ARQUIVO ...: Monta o XML das Cidades 
// BY ........: Tamer Mohamed Elmenoufi     
// DATA ......: 17/12/2006              
/******************************************************************/

//CONECTA AO MYSQL                     
        


//RECEBE PAR�METRO                     
$disciplina = $_POST["disciplina"]; 
//$disciplina = 1;

//QUERY  
$sql = " 
       SELECT a.codigo, a.nome    
        FROM  cadastro_professor a 
		left join professor_disciplina b on a.codigo=b.codigo_professor
		where b.codigo_disciplina = '".$disciplina."'
		ORDER BY a.nome";


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
	  $descricao = mysql_result($sql, $i, "nome");
      $xml .= "<professores>\n";     
      $xml .= "<codigo>".$codigo."</codigo>\n";                  
      $xml .= "<descricao>".$descricao."</descricao>\n";         
      $xml .= "</professores>\n";    
   }//FECHA FOR                 
   
   $xml.= "</dados>\n";
   
   //CABE�ALHO
   Header("Content-type: application/xml; charset=iso-8859-1"); 
}//FECHA IF (row)                                               

//PRINTA O RESULTADO  
echo $xml;            
?>
