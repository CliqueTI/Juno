<?php


namespace CliqueTI\Juno;


class Charge extends Juno {

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

    public function new(array $fields=null, $xResourceToken=null):Charge {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('api-integration/charges', 'POST');

        return $this;
    }

    public function get(?array $fields=null, $xResourceToken=null):Charge {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Fields */
        $this->fields($fields,'query');

        /* Request */
        $this->request('api-integration/charges', 'GET');

        return $this;
    }

}