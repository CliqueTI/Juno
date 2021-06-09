<?php


namespace CliqueTI\Juno;

use CliqueTI\FileManager\File;

require __DIR__.'/../config.php';

/**
 * Class Juno
 * @package CliqueTI\Juno
 */
abstract class Juno {

    /** @var string $apiUrl */
    private $apiUrl;

    /** @var string $endPoint */
    private $endPoint;

    /** @var string $method */
    private $method;

    /** @var array $headers */
    private $headers;

    /** @var array|null $fields */
    private $fields;

    /** @var mixed $response */
    private $response;

    /** @var bool $sslVerifypeer */
    private $sslVerifypeer = !SANDBOX;

    /** @var array|null $accessToken */
    protected $accessToken;

    /** @var array $log */
    private $log;

    /**
     * Juno constructor.
     */
    public function __construct() {
        $this->apiUrl = (SANDBOX?SANDBOXURL:APIURL);
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @return bool
     */
    protected function authenticate(string $clientId, string $clientSecret):bool {
        /* Cache Token */
        $cacheToken = (new File(__DIR__.'/../cache'))->read("{$clientId}.json");

        /* First Access */
        if(!$cacheToken){
            $this->log[] =  "Gerando Access Token Primeiro Acesso";
            if($accessToken = $this->generateAccessToken($clientId,$clientSecret)){
                $this->accessToken = $this->response->access_token;
                (new File(__DIR__.'/../cache'))->write("{$clientId}.json",json_encode((array)$this->response));
                return true;
            } else {
                return false;
            }
        }

        /* Convert Token */
        $cacheToken = json_decode($cacheToken, true);

        /* Convert Date */
        $atualDate = strtotime(date("Y-m-d H:i:s"));
        $expiresIn = strtotime($cacheToken['expires_in']);

        /* Renew Access Token */
        if($atualDate >= $expiresIn){
            $this->log[] =  "Renovando Token de Acesso";
            if($accessToken = $this->generateAccessToken($clientId,$clientSecret)){
                $this->accessToken = $this->response->access_token;
                (new File(__DIR__.'/../cache'))->write("{$clientId}.json",json_encode((array)$this->response));
                return true;
            } else {
                return false;
            }
        }

        /* Cache Token Is Valid */
        $this->log[] =  "Token de Acesso Dentro da Validade";
        $this->accessToken = $cacheToken['access_token'];
        return true;
    }

    /**
     * @param array|null $headers
     */
    protected function headers(?array $headers):void {
        if(!$headers){return;}
        foreach ($headers as $k => $v) {
            $this->header($k,$v);
        }
    }

    /**
     * @param string $key
     * @param string|null $value
     */
    protected function header(string $key, string $value=null):void {
        $this->headers[] = "{$key}: {$value}";
    }

    /**
     * @param array|null $fields
     * @param string $format
     */
    protected function fields(?array $fields, string $format="json"): void {
        if($format == "json") {
            $this->fields = (!empty($fields) ? json_encode($fields) : null);
        }
        if($format == "query"){
            $this->fields = (!empty($fields) ? http_build_query($fields) : null);
        }
    }

    /**
     * @param string $endPoint
     * @param string $method
     * @param string|null $apiUrl
     */
    protected function request(string $endPoint, string $method, string $apiUrl = null):void {
        $this->log[] =  "Requisitando Recursos";
        $this->endPoint = $endPoint;
        $this->method = $method;
        $this->dispatch($apiUrl);
    }

    /**
     * @param array|null $files
     */
    protected function upload(?array $files):void {
        if(!$files){$this->fields = null; return;}
        foreach ($files as $key => $field){
            $this->fields[$key] = curl_file_create(
                $field['tmp_name'],
                $field['type'],
                $field['name']
            );
        }
    }

    /**
     * @return mixed
     */
    public function response() {
        return $this->response;
    }

    /**
     * @return string|null
     */
    public function error():?string {
        return (empty($this->response->error)?null:$this->response->error);
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @return object|null
     */
    private function generateAccessToken(string $clientId, string $clientSecret):?object {
        /* Headers */
        $this->header('Authorization',"Basic " . base64_encode(CLIENTID . ':' . CLIENTSECRET));
        $this->header('Content-Type',"application/x-www-form-urlencoded");
        /* Fields */
        $this->fields(["grant_type"=>"client_credentials"],"query");
        /* Request */
        $this->request('oauth/token','POST',(SANDBOX?SANDBOXSERVERAUTH:SERVERAUTH));
        /* Return */
        if($this->error()){
            $this->log[] =  "Erro ao Gerar Token de Acesso ({$this->error()})";
            return null;
        } else {
            $this->log[] =  "Token de Acesso Gerado com Sucesso";
            $this->response->expires_in = date("Y-m-d H:i:s", (strtotime(date("Y-m-d H:i:s") . "+ ".$this->response->expires_in." seconds")));
            return $this->response;
        }
    }

    /**
     * @param string|null $apiUrl
     */
    private function dispatch(?string $apiUrl):void {
        $apiUrl = ($apiUrl??$this->apiUrl);
        $this->log[] =  "Endereço da Requisição: {$apiUrl}/{$this->endPoint}";
        $curl = curl_init("{$apiUrl}/{$this->endPoint}");
        curl_setopt_array($curl,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_POSTFIELDS => $this->fields,
            CURLOPT_HTTPHEADER => ($this->headers),
            CURLOPT_SSL_VERIFYPEER => $this->sslVerifypeer,
            CURLINFO_HEADER_OUT => true
        ]);
        $this->response = json_decode(curl_exec($curl));
        $this->headers = null;
        $this->fields = null;
        $this->endPoint = null;
        curl_close($curl);
    }

}