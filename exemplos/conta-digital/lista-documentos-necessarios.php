<?php

require __DIR__."/../../vendor/autoload.php";

$doc = new \CliqueTI\Juno\Documents();
$doc->get('9108D272A3B38E2ED263F624513145E19B253BB76609BBB3CDEBCC7B5C6B365C');

echo "<pre>";
print_r($doc->response());

/*

EXEMPLO DE RETORNO

stdClass Object
(
    [_embedded] => stdClass Object
        (
            [documents] => Array
                (
                    [0] => stdClass Object
                        (
                            [id] => doc_14DB6A12380528F1
                            [type] => ID
                            [description] => Documento de identificação (RG ou CNH)
                            [approvalStatus] => AWAITING
                            [_links] => stdClass Object
                                (
                                    [self] => stdClass Object
                                        (
                                            [href] => https://sandbox.boletobancario.com/api-integration/documents/doc_14DB6A12380528F1
                                        )

                                )

                        )

                    [1] => stdClass Object
                        (
                            [id] => doc_5E7603BD17B89472
                            [type] => SELFIE
                            [description] => Selfie
                            [approvalStatus] => AWAITING
                            [_links] => stdClass Object
                                (
                                    [self] => stdClass Object
                                        (
                                            [href] => https://sandbox.boletobancario.com/api-integration/documents/doc_5E7603BD17B89472
                                        )

                                )

                        )

                )

        )

    [_links] => stdClass Object
        (
            [self] => stdClass Object
                (
                    [href] => https://sandbox.boletobancario.com/api-integration/documents
                )

        )

)

 */