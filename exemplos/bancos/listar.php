<?php

require __DIR__."/../../vendor/autoload.php";

$bank = new \CliqueTI\Juno\Banks();
$bank->get();

echo "<pre>";
print_r($bank->response());
