<?php


namespace NicAPI\Manager\Transformers;


use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Traits\TransformTraits;
use NicAPI\NicAPI;

abstract class ResponseTransformer
{

    use TransformTraits, Helper;

    function transformResponse($data)
    {
        foreach (get_class_methods($this) as $method) {
            if($this->startsWith($method, 'set')) {
                $toSet = strtolower(str_split($method, 3)[1]);
                $this->$toSet = $data[$toSet];
            }
        }
        return $this;
    }

}