<?php

require __DIR__."/../../vendor/autoload.php";

$charge = new \CliqueTI\Juno\Charges();
$charge->new([
    'charge' => [
        'description'   => 'Descrição da Cobrança',
        'amount'        => '10.00',
        'paymentTypes'  => ['CREDIT_CARD']
    ],
    'billing' => [
        'name'              => 'John Doe',
        'document'          => '97729470055'
    ]
]);

echo "<pre>";
print_r($charge->response());

/*

EXEMPLO DE RETORNO

CARTAO DE CREDITO:

stdClass Object
(
    [_embedded] => stdClass Object
        (
            [charges] => Array
                (
                    [0] => stdClass Object
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

                )

        )

)


BOLETO:

stdClass Object
(
    [_embedded] => stdClass Object
        (
            [charges] => Array
                (
                    [0] => stdClass Object
                        (
                            [id] => chr_F6BE84C89CF3BB218410C08846538B04
                            [code] => 136544089
                            [reference] =>
                            [dueDate] => 2021-06-07
                            [link] => https://pay-sandbox.juno.com.br/charge/boleto.pdf?token=1285670:m:babd30022e80dcfb1aacde7d4ca82d7892e4f7d17b4de5ee4560b3d2e242fcab
                            [checkoutUrl] => https://pay-sandbox.juno.com.br/checkout/5E61B0AEB8E584D550F935E30E38FF63DFE95ED77A333347
                            [installmentLink] => https://pay-sandbox.juno.com.br/charge/boleto.pdf?token=136544089:d49316536bf1284e0eb8a27017437b6ce846559bcb0dd14d849a2ab9b849b936
                            [payNumber] => BOLETO TESTE - Não é válido para pagamento
                            [amount] => 10
                            [status] => ACTIVE
                            [billetDetails] => stdClass Object
                                (
                                    [bankAccount] => 0001/1000017759-5
                                    [ourNumber] => 000000136544089-1
                                    [barcodeNumber] => 38398864400000010000000177590000001365440891
                                    [portfolio] => 0001
                                )

                            [_links] => stdClass Object
                                (
                                    [self] => stdClass Object
                                        (
                                            [href] => https://sandbox.boletobancario.com/api-integration/charges/chr_F6BE84C89CF3BB218410C08846538B04
                                        )

                                )

                        )

                )

        )

)

 */
