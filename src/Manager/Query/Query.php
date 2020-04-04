<?php


namespace NicAPI\Manager\Query;


use NicAPI\Manager\Objects\ResponseObject;
use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Traits\TransformTraits;
use NicAPI\Manager\Transformers\Domain\Domain;
use NicAPI\Manager\Transformers\Domain\Handle;
use NicAPI\NicAPI;

class Query
{

    use Helper, TransformTraits;

    public $queriesWhere;
    public $orderQuery;
    public $limit;
    public $offset;

    protected $targetObjectName;
    protected $targetTransformerClass;

    protected $nicAPI;
    protected $endpoint;

    public function __construct(NicAPI $nicAPI, $endpoint)
    {
        $this->nicAPI = $nicAPI;
        $this->endpoint = $endpoint;
        $this->queriesWhere = ['fields' => []];
        $this->orderQuery = [];
        $this->limit = null;
        $this->offset = 0;
    }

    /**
     * @return mixed
     */
    public function getTargetObjectName()
    {
        return $this->targetObjectName;
    }

    /**
     * @param mixed $targetObjectName
     */
    public function setTargetObjectName($targetObjectName)
    {
        $this->targetObjectName = $targetObjectName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTargetTransformerClass()
    {
        return $this->targetTransformerClass;
    }

    /**
     * @param mixed $targetTransformerClass
     */
    public function setTargetTransformerClass($targetTransformerClass)
    {
        $this->targetTransformerClass = $targetTransformerClass;
        return $this;
    }

    public function setLimit($limit = null)
    {
        $this->limit = $limit;
        return $this;
    }

    public function setOffset($offset = 0)
    {
        $this->offset = $offset;
        return $this;
    }

    public function where($key, $operator, $value)
    {
        $this->queriesWhere['fields'][] = [
            'key' => $key,
            'operator' => $operator,
            'value' => $value
        ];
        return $this;
    }

    public function sortBy($key, $sortTyp = 'ASC')
    {
        $this->orderQuery['order'][$key] = $sortTyp;
        return $this;
    }

    public function resetSort()
    {
        $this->orderQuery = [];
        return $this;
    }

    public function whereBetween($key, $from, $to)
    {
        $this->where($key, '>=', $from)->where($key, '<=', $to);
        return $this;
    }

    public function whereNull($key)
    {
        return $this->where($key, '===', null);
    }

    public function whereNotNull($key)
    {
        return $this->where($key, '!==', null);
    }

    /**
     * "Paginate" the collection by slicing it into a smaller collection.
     *
     * @param int $page
     * @param int $perPage
     * @return static
     */
    public function paginate($page, $perPage)
    {
        $this->offset = max(0, ($page - 1) * $perPage);
        $this->limit = $perPage;
        return $this;
    }

    /**
     * Handle dynamic method calls into the method.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if ($this->startsWith($method, 'where'))
            return $this->dynamicWhere($method, $parameters);
    }

    /**
     * Handles dynamic "where" clauses to the query.
     *
     * @param string $method
     * @param array $parameters
     * @return $this
     */
    public function dynamicWhere($method, $parameters)
    {
        $finder = substr($method, 5);

        $segments = preg_split(
            '/(And|Or)(?=[A-Z])/', $finder, -1, PREG_SPLIT_DELIM_CAPTURE
        );

        $index = 0;

        foreach ($segments as $segment) {
            $this->addDynamic($segment, $parameters, $index);
            $index++;
        }

        return $this;
    }

    public function addDynamic($segment, $parameters, $index)
    {
        $this->where($this->snake($segment), '=', $parameters[$index]);
    }

    public function get($endpoint = '')
    {
        $response = $this->getResponseObject($this->endpoint($endpoint), [
            'filter' => $this->queriesWhere,
            'limit' => $this->limit,
            'offset' => $this->offset
        ]);
        $responseList = $response->getData()->{$this->targetObjectName};

        $list = [];

        if (is_array($responseList))
            foreach ($responseList as $item)
                $list[] = (new $this->targetTransformerClass())->transformResponse($item);
        return $list;
    }

    public function first($endpoint = '')
    {
        return $this->get()[0];
    }

    function getResponseObject($endpoint, $params = null): ResponseObject
    {
        return $this->transformResponse($this->nicAPI->request('GET', $endpoint, $params));
    }

    function postResponseObject($endpoint, $params = null): ResponseObject
    {
        return $this->transformResponse($this->nicAPI->request('POST', $endpoint, $params));
    }

    function putResponseObject($endpoint, $params = null): ResponseObject
    {
        return $this->transformResponse($this->nicAPI->request('PUT', $endpoint, $params));
    }

    function deleteResponseObject($endpoint, $params = null): ResponseObject
    {
        return $this->transformResponse($this->nicAPI->request('DELETE', $endpoint, $params));
    }

    function endpoint($endpoint = '')
    {
        return $endpoint != '' ? $this->endpoint.'/'.$endpoint : $this->endpoint;
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
