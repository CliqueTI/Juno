<?php


namespace CliqueTI\Juno;

require __DIR__ . "/../config.php";

/**
 * Class Juno
 * @package CliqueTI\Juno
 */
abstract class Juno {

    /** @var $apiUrl */
    private $apiUrl;

    /** @var object $accesToken */
    public $accessToken;

    /** @var $endPoint */
    private $endPoint;

    /** @var $method */
    private $method;

    /** @var $headers */
    private $headers;

    /** @var $fields */
    private $fields;

    /** @var bool $sslVerifypeer */
    private $sslVerifypeer = false;

    /** @var */
    protected $response;

    public function __construct() {
        $this->apiUrl = $this->apiUrl();
    }

    public function Authentication(?array $accessToken):Juno {

        /* Objeto Access Token - Access Token Object */
        $aTokenObj = new AccessToken();

        /* Primeiro Acesso - First Access */
        if(empty($accessToken['expires_in'])){
            $this->accessToken = (object) $aTokenObj->generateToken();
            return $this;
        }

        /* Converte Datas - Convert Date */
        $atualDate = strtotime(date("Y-m-d H:i:s"));
        $expiresIn = strtotime($accessToken['expires_in']);

        /* Demais Acessos - Other Access */
        if($atualDate >= $expiresIn){
            $this->accessToken = (object) $aTokenObj->generateToken();
            return $this;
        }

        /* Saida Token Válido - Exit valid token */
        $this->accessToken = (object) $accessToken;
        return $this;

    }

    public function request(string $endpoint, string $method):void {
        /* Filter */
        $endpoint = filter_var($endpoint, FILTER_DEFAULT);
        $method = filter_var($method, FILTER_DEFAULT);
        /* Persists */
        $this->endPoint = ($endpoint[0] == "/" ? mb_substr($endpoint, 1) : $endpoint);
        $this->method = ($method[0] == "/" ? mb_substr($method, 1) : $method);
        /* Dispatch */
        $this->dispatch();
    }

    public function response() {
        return $this->response;
    }

    public function error() {
        return (!empty($this->response->error) ? $this->response->error : null);
    }

    protected function apiUrl() {
        if(SANDBOX){
            return SANDBOXURL;
        } else {
            return APIURL;
        }
    }

    protected function header(?string $key, ?string $value): void {
        if(!$key || is_int($key)){ return; }
        $key = filter_var($key, FILTER_SANITIZE_STRIPPED);
        $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
        $this->headers[] = "{$key}: {$value}";
    }

    protected function headers(?array $headers): void {
        if (!$headers) { return; }
        foreach ($headers as $k => $v) {
            $this->header($k,$v);
        }
    }

    protected function fields(?array $fields, string $format="json"): void {
        if($format == "json") {
            $this->fields = (!empty($fields) ? json_encode($fields) : null);
        }
        if($format == "query"){
            $this->fields = (!empty($fields) ? http_build_query($fields) : null);
        }
    }

    private function dispatch():void {

        $curl = curl_init("{$this->apiUrl}/{$this->endPoint}");
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

//        echo "<pre>";
//        print_r(curl_getinfo($curl));
//        echo "<hr>";
//        print_r($this->fields);
//        echo "</pre>";

        curl_close($curl);

    }
}