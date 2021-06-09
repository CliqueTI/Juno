<?php


namespace CliqueTI\Juno;


/**
 * Class DigitalAccounts
 * @package CliqueTI\Juno
 */
class DigitalAccounts extends Juno {

    /**
     * DigitalAccounts constructor.
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(string $clientId=CLIENTID, string $clientSecret=CLIENTSECRET) {
        parent::__construct();
        $this->authenticate($clientId,$clientSecret);

        /* Headers */
        $this->headers([
            "Authorization" => "Bearer  " . $this->accessToken,
            "X-Api-Version" => XAPIVERSION,
            "Content-Type"  => "application/json;charset=utf-8"
        ]);
    }

    /**
     * @param array $fields
     * @return DigitalAccounts
     */
    public function new(array $fields): DigitalAccounts {

        /* Header */
        $this->header('X-Resource-Token', XRESOURCETOKEN);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('digital-accounts','POST');

        return $this;

    }

    /**
     * @param string $xResourceToken
     * @return DigitalAccounts
     */
    public function get(string $xResourceToken = XRESOURCETOKEN): DigitalAccounts {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Request */
        $this->request('digital-accounts','GET');

        return $this;
    }

    /**
     * @param array $fields
     * @param string $xResourceToken
     * @return DigitalAccounts
     */
    public function update(array $fields, string $xResourceToken): DigitalAccounts {

        /* Header */
        $this->header('X-Resource-Token', XRESOURCETOKEN);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('digital-accounts','PATCH');

        return $this;

    }

}