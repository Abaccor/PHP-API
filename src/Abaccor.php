<?php


namespace Abaccor;

use Abaccor\Exceptions\AbaccorException;
use Exception;

class Abaccor {

    protected $endpoint;
    protected $api_key;

    public function __construct($endpoint, $api_key) {

        if (!preg_match('/https:\/\/.+/', $endpoint)) throw new Exception('Endpoint inválido');

        if (substr($endpoint, -1, 1) != '/') $endpoint .= '/';

        if (!preg_match('/^[a-f0-9]{64}$/', $api_key)) throw new Exception('API KEY inválido');

        $this->endpoint = $endpoint;
        $this->api_key = $api_key;
    }

    public function generarCfdi33($data) {
        return $this->call('cfdi33/generar', $data);
    }

    protected function call($method, $params) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint . $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: ' . $this->api_key,
            ),
        ));

        $response = curl_exec($curl);
        if (!$response) {
            throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        $response = json_decode($response);

        if ($response->status === 'fail') {
            throw new AbaccorException(@$response->code . ': ' . @$response->message);
        }

        return $response;

    }

}