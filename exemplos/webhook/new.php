<?php

require __DIR__."/../../vendor/autoload.php";

$webhook = new \CliqueTI\Juno\Webhooks();
$webhook->new([
    'url' => 'https://api.meusistema.com.br/webhooks', //Max 255 caracteres
    'eventTypes' => [
        "DIGITAL_ACCOUNT_CREATED","DIGITAL_ACCOUNT_STATUS_CHANGED","PAYMENT_NOTIFICATION","CHARGE_STATUS_CHANGED"
    ]
]);

echo "<pre>";
print_r($webhook->response());

/*

EXEMPLO DE RETORNO

stdClass Object
(
    [id] => wbh_F05F16A599315B31
    [url] => https://api.meusistema.com.br/webhooks
    [secret] => 199e4f6513ace7f04457a58a1064d80e24bee88dbd9b864a8a8760dd0efbfee5
    [status] => ACTIVE
    [eventTypes] => Array
        (
            [0] => stdClass Object
                (
                    [id] => evt_CFCECF82F4BBED68
                    [name] => CHARGE_STATUS_CHANGED
                    [label] => O status de uma cobrança foi alterado
                    [status] => ENABLED
                )

            [1] => stdClass Object
                (
                    [id] => evt_DC82C7B04A3050D4
                    [name] => DIGITAL_ACCOUNT_CREATED
                    [label] => Conta digital criada
                    [status] => ENABLED
                )

            [2] => stdClass Object
                (
                    [id] => evt_4B3A979C94349E9E
                    [name] => DIGITAL_ACCOUNT_STATUS_CHANGED
                    [label] => O estado de uma conta digital foi alterado
                    [status] => ENABLED
                )

            [3] => stdClass Object
                (
                    [id] => evt_3891C9EEE7F6CC9A
                    [name] => PAYMENT_NOTIFICATION
                    [label] => Uma notificação de pagamento foi gerada
                    [status] => ENABLED
                )

        )

    [_links] => stdClass Object
        (
            [self] => stdClass Object
                (
                    [href] => https://sandbox.boletobancario.com/api-integration/notifications/webhooks/wbh_F05F16A599315B31
                )

        )

)

 */