<?php


namespace NicAPI\Manager\Handler;


use NicAPI\Manager\Objects\ResponseObject;
use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Transformers\ResponseTransformer;
use NicAPI\NicAPI;

class Handler
{

    use Helper;

    protected $nicAPI;
    protected $endpoint;

    public function __construct(NicAPI $nicAPI, $endpoint)
    {
        $this->nicAPI = $nicAPI;
        $this->endpoint = $endpoint;
    }

    /**
     * @return NicAPI
     */
    public function getNicAPI(): NicAPI
    {
        return $this->nicAPI;
    }

    /**
     * @param NicAPI $nicAPI
     */
    public function setNicAPI(NicAPI $nicAPI)
    {
        $this->nicAPI = $nicAPI;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /*
     * Request builder | ResponseObject
     */

    public function get($endpoint, $params = null): ResponseObject
    {
        return $this->transformResponse($this->nicAPI->request('GET', $endpoint, $params));
    }

    public function post($endpoint, $params = null): ResponseObject
    {
        return $this->transformResponse($this->nicAPI->request('POST', $endpoint, $params));
    }

    public function put($endpoint, $params = null): ResponseObject
    {
        return $this->transformResponse($this->nicAPI->request('PUT', $endpoint, $params));
    }

    public function delete($endpoint, $params = null): ResponseObject
    {
        return $this->transformResponse($this->nicAPI->request('DELETE', $endpoint, $params));
    }

    public function endpoint($endpoint)
    {
        return $this->endpoint.'/'.$endpoint;
    }

    function transformResponse($response): ResponseObject
    {
        $metadata = $response->metadata;
        $data = $response->data;
        $taskInfo = $response->taskInfo;
        $status = $response->status;
        $messages = $response->messages;
        return new ResponseObject($metadata->serverTransactionId, $status, $metadata->clientTransactionId, $data, $messages, $taskInfo);
    }

}