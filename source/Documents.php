<?php


namespace CliqueTI\Juno;


class Documents extends Juno {

    public function __construct(array $accessToken = null) {
        parent::__construct();

        /* Autentication */
        $this->Authentication($accessToken);

        /* Headers */
        $this->headers([
            "Authorization"     => "Bearer  " . $this->accessToken->access_token,
            "X-Api-Version"     => XAPIVERSION
        ]);
    }

    public function getList($xResourceToken):Documents {

        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Request */
        $this->request('api-integration/documents', 'GET');

        return $this;

    }

    public function sendFiles($xResourceToken, $documentId, $files):Documents {

        /* Head */
        $this->header('X-Resource-Token', ($xResourceToken??XRESOURCETOKEN));

        /* Files */
        $this->upload($files);

        /* Request */
        $this->request('api-integration/documents/'.$documentId.'/files', 'POST');

        return $this;

    }


}