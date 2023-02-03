<?php

//converte data de BR para MySql ou de MySql para BR
function data_formata($data){
if($data){
list($dt,$hora)=explode(" ",$data);
list($ano,$mes,$dia)=explode("-",$dt);
	if($dia=='00' or $mes=='00' or $ano=='0000'){
	$data = false; }else{
	$data = $dia.'-'.$mes.'-'.$ano.' '.$hora;
	}
} return $data; }

// Escreve número FLOAT por extenso
function numero_ext($valor){
  if($valor == 0){ $retorno = 'zero'; }
  if($valor == 1){ $retorno = 'um'; }
  if($valor == 2){ $retorno = 'dois'; }
  if($valor == 3){ $retorno = 'três'; }
  if($valor == 4){ $retorno = 'quatro'; }
  if($valor == 5){ $retorno = 'cinco'; }
  if($valor == 6){ $retorno = 'seis'; }
  if($valor == 7){ $retorno = 'sete'; }
  if($valor == 8){ $retorno = 'oito'; }
  if($valor == 9){ $retorno = 'nove'; }
  if($valor == 10){ $retorno = 'dez'; }
  
  return $retorno;
  
}

function escreve_numero($valor){
   list($a,$b) = explode(",",$valor);
   
   $retorno = ucwords(numero_ext($a))
             . " virgula "
			 . numero_ext($b);

   return $retorno;
}



function CalcularIdade($nascimento) {
$hoje = date("d-m-Y"); //pega a data d ehoje
$aniv = explode("-", $nascimento); //separa a data de nascimento em array, utilizando o símbolo de - como separador
$atual = explode("-", $hoje); //separa a data de hoje em array
  
$idade = $atual[2] - $aniv[2];

if($aniv[1] > $atual[1]) //verifica se o mês de nascimento é maior que o mês atual
{
$idade--; //tira um ano, já que ele não fez aniversário ainda
}
elseif($aniv[1] == $atual[1] && $aniv[0] > $atual[0]) //verifica se o dia de hoje é maior que o dia do aniversário
{
$idade--; //tira um ano se não fez aniversário ainda
}
return $idade; //retorna a idade da pessoa em anos
}


function logs($tab,$opr,$reg,$com){
	global $_SESSION;
	
	mysql_query ("insert into logs set ".
			 	 " usuario = '".$_SESSION[cook_logado]."',".
			 	 " tabela = '".$tab."',".
			 	 " operacao = '".$opr."',".
			 	 " registro = '".trim($reg)."',".
			 	 " data = NOW(),".
			 	 " comando = '".str_replace("'",'`',$com)."'"
				 );

    mysql_query("update $tab set alteracao=NOW(), integracao = '2' where codigo='".trim($reg)."'");


}



function matr($m){
	$n = strlen($m);
	for($i=$n;$i<7;$i++){
		$z .= '0';
	}
	return $z.$m;
}


?>
