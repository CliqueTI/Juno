<?php


namespace CliqueTI\Juno;


/**
 * Class Webhooks
 * @package CliqueTI\Juno
 */
class Webhooks extends Juno {


    /**
     * Webhooks constructor.
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
    public function new(array $fields=null, string $xResourceToken=XRESOURCETOKEN): Webhooks {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request('notifications/webhooks', 'POST');

        return $this;

    }

    /**
     * @param string $xResourceToken
     * @return $this
     */
    public function get(string $xResourceToken=XRESOURCETOKEN): Webhooks {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Request */
        $this->request('notifications/webhooks', 'GET');

        return $this;
    }

    /**
     * @param string $webhooksId
     * @param string $xResourceToken
     * @return $this
     */
    public function getById(string $webhooksId, string $xResourceToken=XRESOURCETOKEN): Webhooks {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Request */
        $this->request("notifications/webhooks/{$webhooksId}", 'GET');

        return $this;
    }

    /**
     * @param array $fields
     * @param string $webhooksId
     * @param string $xResourceToken
     * @return $this
     */
    public function update(array $fields, string $webhooksId, string $xResourceToken=XRESOURCETOKEN): Webhooks {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Fields */
        $this->fields($fields,'json');

        /* Request */
        $this->request("notifications/webhooks/{$webhooksId}", 'PATCH');

        return $this;

    }

    /**
     * @param string $webhooksId
     * @param string $xResourceToken
     * @return $this
     */
    public function delete(string $webhooksId, string $xResourceToken=XRESOURCETOKEN): Webhooks {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Request */
        $this->request("notifications/webhooks/{$webhooksId}", 'PATCH');

        return $this;

    }


}