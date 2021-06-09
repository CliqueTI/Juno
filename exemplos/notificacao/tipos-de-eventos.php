<?php

require __DIR__."/../../vendor/autoload.php";

$doc = new \CliqueTI\Juno\NotificationEventTypes();
$doc->get();

echo "<pre>";
print_r($doc->response());

/*

EXEMPLO DE RETORNO

stdClass Object
(
    [_embedded] => stdClass Object
        (
            [eventTypes] => Array
                (
                    [0] => stdClass Object
                        (
                            [id] => evt_DC2E7E8848B08C62
                            [name] => DOCUMENT_STATUS_CHANGED
                            [label] => O status de um documento foi alterado
                            [status] => ENABLED
                        )

                    [1] => stdClass Object
                        (
                            [id] => evt_4B3A979C94349E9E
                            [name] => DIGITAL_ACCOUNT_STATUS_CHANGED
                            [label] => O estado de uma conta digital foi alterado
                            [status] => ENABLED
                        )

                    [2] => stdClass Object
                        (
                            [id] => evt_DD8056B9AF3A0CD9
                            [name] => TRANSFER_STATUS_CHANGED
                            [label] => O status de uma transferência foi alterado
                            [status] => ENABLED
                        )

                    [3] => stdClass Object
                        (
                            [id] => evt_8C42A83724B3E52F
                            [name] => P2P_TRANSFER_STATUS_CHANGED
                            [label] => O status de uma transferência entre contas Juno foi alterado
                            [status] => ENABLED
                        )

                    [4] => stdClass Object
                        (
                            [id] => evt_3891C9EEE7F6CC9A
                            [name] => PAYMENT_NOTIFICATION
                            [label] => Uma notificação de pagamento foi gerada
                            [status] => ENABLED
                        )

                    [5] => stdClass Object
                        (
                            [id] => evt_CFCECF82F4BBED68
                            [name] => CHARGE_STATUS_CHANGED
                            [label] => O status de uma cobrança foi alterado
                            [status] => ENABLED
                        )

                    [6] => stdClass Object
                        (
                            [id] => evt_D48AFD95E13CA227
                            [name] => BILL_PAYMENT_STATUS_CHANGED
                            [label] => O status de um pagamento de contas foi alterado
                            [status] => ENABLED
                        )

                    [7] => stdClass Object
                        (
                            [id] => evt_8C4AD03A5B2A03FC
                            [name] => CHARGE_READ_CONFIRMATION
                            [label] => Confirmação de leitura de notificação de cobrança e/ou documento de cobrança
                            [status] => ENABLED
                        )

                    [8] => stdClass Object
                        (
                            [id] => evt_19E15A89466B7E46
                            [name] => CHARGE_CREATED
                            [label] => Indica que uma nova cobrança foi criada
                            [status] => ENABLED
                        )

                    [9] => stdClass Object
                        (
                            [id] => evt_DC82C7B04A3050D4
                            [name] => DIGITAL_ACCOUNT_CREATED
                            [label] => Conta digital criada
                            [status] => ENABLED
                        )

                )

        )

    [_links] => stdClass Object
        (
            [self] => stdClass Object
                (
                    [href] => https://sandbox.boletobancario.com/api-integration/notifications/event-types
                )

        )

)

 */