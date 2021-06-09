<?php

require __DIR__."/../../vendor/autoload.php";

$dAccount = new \CliqueTI\Juno\DigitalAccounts();
$dAccount->get('14142BB34E4552506F75FC085857FDE5B51E74332DC012CF6F28584C767B6410');

echo "<pre>";
print_r($dAccount->response());

/*

EXEMPLO DE RETORNO

stdClass Object
(
    [id] => dac_90B4A1C103AB82FA
    [type] => PAYMENT
    [status] => AWAITING_DOCUMENTS
    [personType] => F
    [document] => 23000355022
    [createdOn] => 2021-06-04T17:43:09.738-03:00
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
