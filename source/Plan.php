<?php


namespace CliqueTI\Juno;


class Plan extends Juno {

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

    public function new(array $fields=null, $xResourceToken=null):Plan {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('api-integration/plans', 'POST');

        return $this;
    }

    public function get(string $id = null, $xResourceToken=null):Plan {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Request */
        $this->request("api-integration/plans/{$id}", 'GET');

        return $this;
    }

}