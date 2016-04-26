<form method="POST" action="">
    <input name="num1" placeholder="Numero 1">
    <select name="op">
        <option value="soma">+</option>
        <option value="sub">-</option>
        <option value="div">/</option>
        <option value="mult">*</option>
    </select>
    <input name="num2" placeholder="Numero 2">
    <input type="submit" value="Calcular">
</form>




<?php
// Observacoes:
// Adicionar a extensao php_soap no php.ini

// configurando o objeto executor cliente com o endereco do servidor
$client = new SoapClient(null, array(
	'location' => 'http://localhost/webservice/soap/server.php',  // ex.: http://localhost/soap/server.php
	'uri' => 'http://localhost/webservice/soap/',  				// ex.: http://localhost/soap/
	'trace' => 1));

// chamada do servico SOAP
if($_SERVER['REQUEST_METHOD']=='POST'){
    $a = $_REQUEST['num1'];
    $b = $_REQUEST['num2'];
    $op = $_REQUEST['op'];    
    $result = $client->calc($a,$b,$op);
}


// verifica erros na execucao do servico e exibe o resultado
if(isset($result)){
    print_r ($client->retorno($result));
}
//    if (is_soap_fault($result)){
//            trigger_error("SOAP Fault: (faultcode: {$result->faultcode},
//            faultstring: {$result->faulstring})", E_ERROR);
//    }else{
//            echo "Resultado Encontrado: ";
//            print_r($result);
//    }
?>
