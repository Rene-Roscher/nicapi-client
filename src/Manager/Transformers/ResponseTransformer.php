<?php


namespace NicAPI\Manager\Transformers;


use NicAPI\Manager\Query\Query;
use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Traits\TransformTraits;
use NicAPI\NicAPI;

abstract class ResponseTransformer
{

    use TransformTraits, Helper;

    protected $dates = [
        'created_at',
        'deleted_at',
        'updated_at',
        'suspended_at'
    ];

    function transformResponse($data)
    {
        foreach ($this->fillable as $value) {
            $this->{$value} = $data->$value ?: null;
        }
        return $this;
    }

    public function query(): Query
    {
        return new Query($this->nicAPI, $this->endpoint);
    }

}
