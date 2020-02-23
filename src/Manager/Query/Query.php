<?php


namespace NicAPI\Manager\Query;


use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Traits\TransformTraits;
use NicAPI\NicAPI;

class Query
{

    use Helper, TransformTraits;

    public $queriesWhere = ['filter']['fields'];
    public $orderQuery = [];
    public $limit = 1;
    public $offset = 0;

    protected $nicAPI;
    protected $endpoint;

    public function __construct(NicAPI $nicAPI, $endpoint)
    {
        $this->nicAPI = $nicAPI;
        $this->endpoint = $endpoint;
    }

    public function setLimit($limit = 1)
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
        $this->queriesWhere[] = [
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

    public function get()
    {
        return $this->nicAPI->request('GET', $this->endpoint, [
            $this->queriesWhere,
            'limit' => $this->limit,
            'offset' => $this->offset,
        ]);
    }

}