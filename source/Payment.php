<?php


namespace CliqueTI\Juno;


/**
 * Class Payment
 * @package CliqueTI\Juno
 */
class Payment extends Juno {

    /**
     * Payment constructor.
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
     * @param array|null $fields
     * @param string $xResourceToken
     * @return $this
     */
    public function new(array $fields=null, string $xResourceToken=XRESOURCETOKEN): Payment {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('payments', 'POST');

        return $this;
    }

    /**
     * @param array|null $fields
     * @param string|null $paymentId
     * @param string $xResourceToken
     * @return $this
     */
    public function refund(array $fields = null, string $paymentId=null, string $xResourceToken=XRESOURCETOKEN): Payment {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request("payments/{$paymentId}/refunds", 'POST');

        return $this;
    }

    /**
     * @param array|null $fields
     * @param string|null $paymentId
     * @param string $xResourceToken
     * @return $this
     */
    public function capture(array $fields = null, string $paymentId=null, string $xResourceToken=XRESOURCETOKEN): Payment {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request("payments/{$paymentId}/capture", 'POST');

        return $this;
    }

}