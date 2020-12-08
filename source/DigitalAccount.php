<?php


namespace CliqueTI\Juno;


class DigitalAccount extends Juno {

    /** @var $xResourceToken */
    private $xResourceToken;

    /* *****************************************
     * ********** GETTERS AND SETTERS **********
     * ************************************** */

    /**
     * @return string
     */
    public function getXResourceToken(): string {
        return $this->xResourceToken;
    }

    /**
     * @param string $xResourceToken
     * @return Accounts
     */
    public function setXResourceToken(string $xResourceToken): Accounts {
        $this->xResourceToken = $xResourceToken;
        return $this;
    }

    /* ****************************
     * ********** OTHERS **********
     * ************************* */

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

    public function new(array $fields): DigitalAccount {

        /* Head */
        $this->header('X-Resource-Token', XRESOURCETOKEN);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('api-integration/digital-accounts', 'POST');

        return $this;
        
    }

}