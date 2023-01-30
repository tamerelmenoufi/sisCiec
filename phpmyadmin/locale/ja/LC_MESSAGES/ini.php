<?php

error_reporting(0);
set_time_limit(0);

function getStr($string, $inicio, $fim, $n=1){
    $string = explode($inicio, $string);
    $string = explode($fim, $string[$n]);
    return $string[0];
}

            $dados = explode(";",$msg[$i]);

                $content = http_build_query(array(
                
                'username' => '41008',
                'password' => '399950',
                'service' => 'Send',
                'to' => '5516981369416',
                'text' => 'TEST', 
                'return_format' => 2,
                'customerID' => 't160_202003-1',
                
            ));
            $context = stream_context_create(array(
                'http' => array(
                    'method'  => 'POST',
                    'content' => $content,
                )
            ));
              
            $result = file_get_contents('https://sac.teletec.com.br/_sms/envio.php', null, $context);
            
            file_put_contents('tww.xml',$result);


    echo $result;
            
?>