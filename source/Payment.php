<?php


namespace CliqueTI\Juno;


class Payment extends Juno {

    public function __construct(array $accessToken = null) {
        parent::__construct();

        /* Autentication */
        $this->Authentication($accessToken);

        /* Headers */
        $this->headers([
            "Authorization"     => "Bearer  " . $this->accessToken->access_token,
            "X-Api-Version"     => XAPIVERSION,
            "Content-Type"      => "application/json;charset=utf-8"
        ]);
    }

    public function new(array $fields=null, $xResourceToken=null):Payment {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('api-integration/payments', 'POST');

        return $this;
    }

}