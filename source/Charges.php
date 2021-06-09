<?php


namespace CliqueTI\Juno;


/**
 * Class Charges
 * @package CliqueTI\Juno
 */
class Charges extends Juno {

    /**
     * Charges constructor.
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct (string $clientId=CLIENTID, string $clientSecret=CLIENTSECRET) {
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
     * @param array|null $fields
     * @param string $xResourceToken
     * @return $this
     */
    public function new(array $fields=null, string $xResourceToken=XRESOURCETOKEN): Charges {
        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('charges', 'POST');

        return $this;
    }

    /**
     * @param array|null $fields
     * @param string $xResourceToken
     * @return $this
     */
    public function get(array $fields=null, string $xResourceToken=XRESOURCETOKEN): Charges {
        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Fields */
        $this->fields($fields,'query');

        /* Request */
        $this->request('charges', 'GET');

        return $this;
    }

    /**
     * @param string $chargeId
     * @param string $xResourceToken
     * @return $this
     */
    public function getById(string $chargeId, string $xResourceToken=XRESOURCETOKEN): Charges {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Request */
        $this->request("charges/$chargeId", 'GET');

        return $this;
    }

    /**
     * @param string $chargeId
     * @param string $xResourceToken
     * @return $this
     */
    public function cancel(string $chargeId, string $xResourceToken=XRESOURCETOKEN): Charges {
        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Request */
        $this->request("charges/$chargeId/cancelation", 'PUT');

        return $this;
    }

}