<?php

namespace NicAPI;

use GuzzleHttp\Client;
use NicAPI\Manager\Handler\Manager;
use NicAPI\Manager\Traits\TransformTraits;

class NicAPI
{

    use TransformTraits;

    protected $httpClient;
    protected $authToken;
    protected $url;
    protected $manager;

    /**
     * Building an instance.
     *
     * NicAPI constructor.
     * @param $authToken
     * @param string $url
     */
    public function __construct($authToken, $url = 'https://connect.nicapi.eu/api/v1')
    {
        $this->authToken = $authToken;
        $this->url = $url;
        $this->httpClient = new Client([
            'allow_redirects' => false,
            'timeout' => 120,
            'headers' => [
                'Authorization' => 'Bearer '. $authToken,
            ]
        ]);
        $this->manager = new Manager($this);
    }

    function request($method, $endpoint, array $params = null)
    {
        if ($method == 'GET' || $method == 'POST' || $method == 'DELETE' || $method == 'PUT' || $method == 'OPTIONS')
            return $this->processResponse($this->httpClient->$method($this->url . '/' . $endpoint, ($method == 'GET') ? [
                'verify' => true,
                'query' => $params
            ] : [
                'verify' => true,
                'form_params' => $params
            ]));
        throw new \LogicException('Method not usable.');
    }

    public function __call($name, $arguments)
    {
        foreach (['get', 'post', 'delete', 'put', 'options'] as $method) {
            if ($name == $method) {
                return call_user_func([$this, 'request'], strtoupper($method), isset($arguments[0]) ? $arguments[0] : [], isset($arguments[1]) ? $arguments[1] : null);
            }
        }
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @return mixed
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return Manager
     */
    public function getManager(): Manager
    {
        return $this->manager;
    }

}
