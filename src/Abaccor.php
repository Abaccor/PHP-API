<?php


namespace Abaccor;

use Abaccor\Exceptions\AbaccorException;

class Abaccor {

    protected $endpoint;
    protected $api_key;

    public function __construct($endpoint, $api_key) {
        $this->endpoint = $endpoint;
        $this->api_key = $api_key;
    }

    public function generarCfdi33($data) {
        return $this->call('cfdi33/generar', $data);
    }

    protected function call($method, $params) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint,
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
        curl_close($curl);
        if (!$response) {
            throw new AbaccorException('No se obtuvo respuesta');
        }
        $response = json_decode($response);

        if ($response->status === 'fail') {
            throw new AbaccorException(@$response->code . ': ' . @$response->message);
        }

        return $response;

    }

}