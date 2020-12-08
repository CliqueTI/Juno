<?php


namespace CliqueTI\Juno;


class BusinessArea extends Juno {

    public function __construct(array $accessToken = null) {
        parent::__construct();

        /* Autentication */
        $this->Authentication($accessToken);

        /* Headers */
        $this->headers([
            "Authorization" => "Bearer  " . $this->accessToken->access_token,
            "X-Api-Version" => XAPIVERSION,
            "Content-Type"  => "application/json;charset=utf-8"
        ]);
    }

    public function get(): BusinessArea {
        /* Request */
        $this->request('api-integration/data/business-areas', 'GET');
        return $this;
    }

}