<?php


namespace CliqueTI\Juno;


/**
 * Class CardToken
 * @package CliqueTI\Juno
 */
class CardToken extends Juno {


    /**
     * CardToken constructor.
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
     * @param string $creditCardHash
     * @param string $xResourceToken
     * @return $this
     */
    public function new(string $creditCardHash, string $xResourceToken=XRESOURCETOKEN):CardToken {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Fields */
        $this->fields(['creditCardHash'=>$creditCardHash],'json');

        /* Request */
        $this->request('credit-cards/tokenization');

        return $this;
    }

}