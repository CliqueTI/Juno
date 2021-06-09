<?php


namespace CliqueTI\Juno;


/**
 * Class NotificationEventTypes
 * @package CliqueTI\Juno
 */
class NotificationEventTypes extends Juno {

    /**
     * NotificationEventTypes constructor.
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
    public function get():NotificationEventTypes {
        $this->request('notifications/event-types','GET');
        return $this;
    }
}