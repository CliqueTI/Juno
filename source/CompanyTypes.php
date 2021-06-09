<?php


namespace CliqueTI\Juno;


/**
 * Class CompanyTypes
 * @package CliqueTI\Juno
 */
class CompanyTypes extends Juno {

    /**
     * CompanyTypes constructor.
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
    public function get():CompanyTypes {
        $this->request('data/company-types','GET');
        return $this;
    }

}