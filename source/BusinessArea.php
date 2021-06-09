<?php


namespace CliqueTI\Juno;


/**
 * Class BusinessArea
 * @package CliqueTI\Juno
 */
class BusinessArea extends Juno {

    /**
     * BusinessArea constructor.
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
    public function get():BusinessArea {
        $this->request('data/business-areas','GET');
        return $this;
    }

}