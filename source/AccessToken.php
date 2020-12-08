<?php


namespace CliqueTI\Juno;


/**
 * Class AccessToken
 * @package CliqueTI\Juno
 */
class AccessToken extends Juno {

    public function generateToken():?object {
        /* Headers */
        $this->headers([
            "Authorization" => "Basic " . base64_encode(CLIENTID . ':' . CLIENTSECRET),
            "Content-Type" => "application/x-www-form-urlencoded"
        ]);

        /* Fields */
        $this->fields([
            'grant_type'=>'client_credentials'
        ], "query");

        /* Request */
        $this->request('authorization-server/oauth/token', 'POST');

        /* Error */
        if(!empty($this->error())){
            return (object) [
                'timestamp' => date("Y-m-d H:i:s"),
                'error'     => $this->error(),
                'details'   => $this->response()->details
            ];
        }

        /* Response */
        return (object) [
            'access_token'  => $this->response()->access_token,
            'token_type'    => $this->response()->token_type,
            'expires_in'    => date("Y-m-d H:i:s", (strtotime(date("Y-m-d H:i:s") . "+ ".$this->response()->expires_in." seconds")))
        ];
    }

}