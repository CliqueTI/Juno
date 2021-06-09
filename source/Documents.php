<?php


namespace CliqueTI\Juno;


/**
 * Class Documents
 * @package CliqueTI\Juno
 */
class Documents extends Juno {

    /**
     * Documents constructor.
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(string $clientId=CLIENTID, string $clientSecret=CLIENTSECRET) {
        parent::__construct();
        $this->authenticate($clientId,$clientSecret);

        /* Headers */
        $this->headers([
            "Authorization" => "Bearer  " . $this->accessToken,
            "X-Api-Version" => XAPIVERSION
        ]);
    }

    /**
     * @param string $xResourceToken
     * @return $this
     */
    public function get(string $xResourceToken = XRESOURCETOKEN): Documents {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Request */
        $this->request('documents', 'GET');

        return $this;
    }

    /**
     * @param string $xResourceToken
     * @param string $documentId
     * @param array $files
     * @return $this
     */
    public function send(string $xResourceToken, string $documentId, array $files): Documents {

        /* Header */
        $this->header('X-Resource-Token', $xResourceToken);

        /* Files */
        $this->upload($files);

        /* Request */
        $this->request('documents/'.$documentId.'/files', 'POST');

        return $this;
    }

}