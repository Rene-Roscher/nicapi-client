<?php


namespace NicAPI\Manager\Handler\Domain;


use NicAPI\Manager\Handler\Handler;
use NicAPI\Manager\Objects\ResponseObject;
use NicAPI\Manager\Query\Query;
use NicAPI\Manager\Transformers\Domain\Domain;
use NicAPI\NicAPI;

class DomainHandler extends Handler
{

    public function getList(): array
    {
        $responseObject = $this->get($this->endpoint('domains'));
        if(!$responseObject->wasSuccess())
            throw new \LogicException();

        $responseDomainList = $responseObject->getData()->domains;
        $domains = [];

        if (is_array($responseDomainList))
            foreach ($responseDomainList as $item)
                $domains[] = (new Domain($this->nicAPI, $this->endpoint))->transformResponse($item);
        return $domains;
    }

    public function query(): Query
    {
        return new Query($this->nicAPI, $this->endpoint('domains'));
    }

    public function findByName($domainName)
    {
        return $this->query()->where('name', '=', $domainName)->get();
    }
}