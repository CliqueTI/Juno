<?php

require __DIR__."/../../vendor/autoload.php";

if($_POST){

    /* 1º Criar Cobrança */
    $charge = new \CliqueTI\Juno\Charges();
    $charge->new([
        'charge' => [
            'description'   => 'Descrição da Cobrança',
            'amount'        => (float)$_POST['amount'], //Formato FLOAT
            'paymentTypes'  => ['CREDIT_CARD']
//            'split'         => [[
//                'recipientToken' => "TOKEN PRIVADO", //Seu APP
//                'percentage'=> '1',
//                'amountRemainder' => true,
//                'chargeFee' => true
//            ],[
//                'recipientToken' => "resourceToken", //VENDEDOR
//                'percentage'=> '99',
//                'amountRemainder' => false,
//                'chargeFee' => false
//            ]]
        ],
        'billing' => [
            'name'              => 'John Doe',
            'document'          => '97729470055'
        ]
    ]);

    /* 2º Checa Erro na Criação da Cobrança */
    if($charge->error()){
        echo "<pre>";
        print_r($charge->response());
        die();
    }

    /* 3º Faz Pagamento */
    $payment = new \CliqueTI\Juno\Payment();
    $payment->new([
        'chargeId' => $charge->response()->_embedded->charges[0]->id,
        'billing' => [
            'email' => 'exemplo@meuemail.com',
            'address' => [
                'street'        => 'Rua Teste de Sistema',
                'number'        => '100',
                'complement'    => 'Sala 01',
                'neighborhood'  => 'Centro',
                'city'          => 'São Paulo',
                'state'         => 'SP',
                'postCode'      => '01001000',
            ]
        ],
        'creditCardDetails' => [
            'creditCardHash' => $_POST['cardHash']
        ]
    ]);

    /* 4º Checa Erro no Pagamento */
    if($payment->error()){
        echo "<pre>";
        print_r($payment->response());
        die();
    }

    /* Sucesso */
    echo "Pagamento Realizado com Sucesso <br><br><pre>";
    print_r($payment->response());
    die();
}


/*

EXEMPLOS DE RETORNO:

SUCESSO:

stdClass Object
(
    [transactionId] => 30841473645dc2
    [installments] => 1
    [payments] => Array
        (
            [0] => stdClass Object
                (
                    [id] => pay_D6C8B696170EA8A8655177446ED45CE7
                    [chargeId] => chr_17F98D7B7A4942E1B3EF626460B9F903
                    [date] => 2021-06-08
                    [releaseDate] => 2021-07-10
                    [amount] => 10
                    [fee] => 0.88
                    [type] => CREDIT_CARD
                    [status] => CONFIRMED
                    [failReason] =>
                )

        )

)

NÃO AUTORIZADO:

stdClass Object
(
    [timestamp] => 2021-06-08T14:28:37.055-03:00
    [status] => 500
    [error] => Internal Server Error
    [details] => Array
        (
            [0] => stdClass Object
                (
                    [message] => Não autorizado. Saldo insuficiente.
                    [errorCode] => 289999
                )

        )

    [path] => /payments
)

*/


?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout Transparente Juno</title>

    <style>
        .content {width: 500px; margin: 20px auto;}
        .content p {text-align: center; font-weight: bold;}
        .content form {display: flex; flex-direction: column;}
        .content form input,
        .content form button { padding: 5px; margin-bottom: 10px; }
        .cardStatus {background-color: #f7f7f7; width: calc(100% - 10px); min-height: 100px; border: 1px solid #b7b7b7; padding: 5px;}
    </style>
</head>
<body>

<div class="content">
    <p>Dados do Cartão</p>
    <form method="post" id="formCard">
        <input type="number" name="cardNumber" id="cardNumber" placeholder="Número do Cartão" required>
        <input type="text" name="holderName" id="holderName" placeholder="Nome (Como esta escrito no cartão)" required>
        <input type="number" name="expirationMonth" id="expirationMonth" placeholder="Mês de Vencimento" maxlength="2" required>
        <input type="number" name="expirationYear" id="expirationYear" placeholder="Ano de Vencimento" maxlength="4" required>
        <input type="number" name="securityCode" id="securityCode" placeholder="Código de Segurança" maxlength="4" required>
        <input type="text" name="amount" id="amount" placeholder="Valor" required>
        <input type="hidden" name="cardHash" id="cardHash">
        <button type="button" id="btnFinish">Finalizar</button>
    </form>

    <div class="cardStatus" id="cardStatus"></div>
</div>

<!--jQuery-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--Juno SandBox-->
<script type="text/javascript" src="https://sandbox.boletobancario.com/boletofacil/wro/direct-checkout.min.js"></script>
<!--Juno Production-->
<!--<script type="text/javascript" src="https://www.boletobancario.com/boletofacil/wro/direct-checkout.min.js"></script>-->

<!--Juno Custom-->
<script src="juno.js"></script>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
        console.log("DOM Loaded");

        /* Juno */
        const PUBLIC_TOKEN = "C76F0C381D68871546E214E856B535263ABC86CA7AB67930E60BC268AE9B6186";

        $('#btnFinish').click(function(){
            console.log('Gerando Hash...')
            getCardHash(PUBLIC_TOKEN, setCharge);
        });

        function setCharge(cardHash){
            console.log('Hash Gerada: ' + cardHash);
            document.getElementById('cardStatus').innerText = 'Hash Gerada: ' + cardHash;
            $('#cardHash').val(cardHash);
            $('#formCard').submit();
        }
        /* /Juno */
    });

</script>

</body>
</html>
