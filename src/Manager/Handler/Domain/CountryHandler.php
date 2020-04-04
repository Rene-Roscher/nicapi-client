<?php


namespace NicAPI\Manager\Handler\Domain;


use NicAPI\Manager\Handler\Handler;
use NicAPI\Manager\Transformers\Domain\Country;
use NicAPI\Manager\Transformers\Domain\Domain;

class CountryHandler extends Handler
{

    protected $targetObjectName = 'countries';
    protected $targetTransformerClass = Country::class;

}
