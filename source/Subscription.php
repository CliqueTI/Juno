<?php


namespace CliqueTI\Juno;


class Subscription extends Juno {

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

    public function new(array $fields=null, $xResourceToken=null):Subscription {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('api-integration/subscriptions', 'POST');

        return $this;
    }

    public function get(string $id = null, $xResourceToken=null):Subscription {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Request */
        $this->request("api-integration/subscriptions/{$id}", 'GET');

        return $this;
    }

    public function deactivate(string $id = null, $xResourceToken=null):Subscription {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Request */
        $this->request("api-integration/subscriptions/{$id}/deactivation", 'POST');

        return $this;
    }

    public function activate(string $id = null, $xResourceToken=null):Subscription {
        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Request */
        $this->request("api-integration/subscriptions/{$id}/activation", 'POST');

        return $this;
    }

}