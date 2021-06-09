<?php


namespace CliqueTI\Juno;


/**
 * Class Banks
 * @package CliqueTI\Juno
 */
class Banks extends Juno {


    /**
     * Banks constructor.
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
     * @return $this
     */
    public function get():Banks {
        $this->request('data/banks','GET');
        return $this;
    }

}