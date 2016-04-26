<?php
// Observacoes:
// Adicionar a extensao php_soap no php.ini

//criacao de uma instancia do servidor (coloque o endereco na sua maquina local)
$server = new SoapServer(null, array('uri' => "http://localhost/webservice/soap/"));  // ex.: http://localhost/soap/

//definicao dos métodos disponíveis para uso do servico ( vai retornar apenas a frase Hello World + parametro que receber + ! )


          function helloWorld($name) {
			return 'Hello World '.$name.'!';
	  }
          function calc($a,$b,$op) {
              if($op =='soma'){  
                $res = $a+$b;
                return 'Resultado da Soma '.$res;
              }
              if($op =='sub'){  
                $res = $a-$b;
                return 'Resultado da Subtração '.$res;
              }
              if($op =='div'){  
                $res = $a/$b;
                return 'Resultado da Divisão '.$res;
              }
              if($op =='mult'){  
                $res = $a*$b;
                return 'Resultado da Multiplicação '.$res;
              }
	  }
          
          function retorno($result){
            if (is_soap_fault($result)){
                $msg = 'Serviço solicitado possui erros!';
                $status = false;
            }else{
                $msg = 'Concluido com sucesso!=> ';
                $status = true;
                return $msg.$result;
            }
          }

//registro do servico na instania
$server->addFunction("helloWorld");
$server->addFunction("calc");
$server->addFunction("retorno");
// chamada do metodo para atender as requisicoes do servico
// se a chamada for um POST executa o método, caso contrario, apenas mostra a lista das funcoes disponiveis
if ($_SERVER["REQUEST_METHOD"]== "POST") {
		$server->handle();
} else {
	$functions = $server->getFunctions();
	print "Métodos disponíveis no serviço:";
	print "<hr />";
	print " <ul>";
	foreach ($functions as $func) {
		print "<li>$func</li>";
	}
	print "</ul>";
}
?>
