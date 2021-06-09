<?php

require __DIR__."/../../vendor/autoload.php";

$charge = new \CliqueTI\Juno\Charges();
$charge->getById('chr_4715C69007B97E70E59D17407DC57214');

echo "<pre>";
print_r($charge->response());

/*

EXEMPLO DE RETORNO

stdClass Object
(
    [id] => chr_4715C69007B97E70E59D17407DC57214
    [code] => 136544099
    [reference] =>
    [dueDate] => 2021-06-07
    [checkoutUrl] => https://pay-sandbox.juno.com.br/checkout/65AD34B0CB3D24941E9A02C6E00F19CC6ED2235D0305C708
    [amount] => 10
    [status] => ACTIVE
    [_links] => stdClass Object
        (
            [self] => stdClass Object
                (
                    [href] => https://sandbox.boletobancario.com/api-integration/charges/chr_4715C69007B97E70E59D17407DC57214
                )

        )

)

 */
