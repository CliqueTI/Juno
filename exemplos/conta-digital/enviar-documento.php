<?php

require __DIR__."/../../vendor/autoload.php";

if($_FILES){
    $doc = new \CliqueTI\Juno\Documents();
    $doc->send(
        '14142BB34E4552506F75FC085857FDE5B51E74332DC012CF6F28584C767B6410',
        'doc_14DB6A12380528F1',
        $_FILES
    );

    echo "<pre>";
    print_r($doc->response());
}

/*

EXEMPLO DE RETORNO

stdClass Object
(
    [id] => doc_14DB6A12380528F1
    [type] => ID
    [description] => Documento de identificação (RG ou CNH)
    [approvalStatus] => VERIFYING
    [_links] => stdClass Object
        (
            [self] => stdClass Object
                (
                    [href] => https://sandbox.boletobancario.com/api-integration/documents/doc_14DB6A12380528F1
                )

        )

)

 */
