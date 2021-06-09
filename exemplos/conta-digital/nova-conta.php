<?php

require __DIR__."/../../vendor/autoload.php";

$dAccount = new \CliqueTI\Juno\DigitalAccounts();
$dAccount->new([
    'type' => 'PAYMENT',
    'name' => 'John Doe',
    'document' => '58391225054',
    'email' => 'mustbevalid@valid.com.br',
    'birthDate' => '1970-01-01',
    'businessArea' => 2029, // Consultar Lista BussinessArea
    'phone' => '4130139650',
    'linesOfBusiness' => 'Sample description',
    'motherName' => 'Lady Marmelade',
    'monthlyIncomeOrRevenue' => 1000.00, //Renda Mensal
    'address' => [
        'street' => 'Praça da Sé',
        'number' => '100',
        'complement' => 'Sala 01',
        'neighborhood' => 'Centro',
        'city' => 'São Paulo',
        'state' => 'SP',
        'postCode' => '01001000'
    ],
    'bankAccount' => [
        'bankNumber' => '001',
        'agencyNumber' => '01020',
        'accountNumber' => '010203',
        'accountType' => 'CHECKING', //CHECKING para Conta Corrente e SAVINGS para Poupança.
        'accountHolder' => [
            'name' => 'John Doe',
            'document' => '58391225054'
        ]
    ],
    'emailOptOut' => true //E-mails Juno cobranças, transferências. True para não e False para sim (Padrão False)
]);

echo "<pre>";
print_r($dAccount->response());


/*

EXEMPLOS:

ERRO NA REQUISIÇÃO:

stdClass Object
(
    [timestamp] => 2021-06-04T17:36:00.792-03:00
    [status] => 400
    [error] => Bad Request
    [details] => Array
        (
            [0] => stdClass Object
                (
                    [field] => birthDate
                    [message] => Campo obrigatório
                    [errorCode] => 431000
                )

        )

    [path] => /digital-accounts
)

REQUISIÇÃO EFETUADA COM SUCESSO:

stdClass Object
(
    [id] => dac_90B4A1C103AB82FA
    [type] => PAYMENT
    [status] => AWAITING_DOCUMENTS
    [personType] => F
    [document] => 23000355022
    [createdOn] => 2021-06-04T17:43:09.738-03:00
    [resourceToken] => 14142BB34E4552506F75FC085857FDE5B51E74332DC012CF6F28584C767B6410
    [accountNumber] => 10000271656
    [_links] => stdClass Object
        (
            [self] => stdClass Object
                (
                    [href] => https://sandbox.boletobancario.com/api-integration/digital-accounts/dac_90B4A1C103AB82FA
                )

        )

)

 */
