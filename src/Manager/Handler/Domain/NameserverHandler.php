<?php


namespace NicAPI\Manager\Handler\Domain;


use NicAPI\Manager\Handler\Handler;
use NicAPI\Manager\Objects\ResponseObject;
use NicAPI\Manager\Transformers\Domain\Nameserver;

class NameserverHandler extends Handler
{

    protected $targetObjectName = 'nameservers';
    protected $targetTransformerClass = Nameserver::class;

    public function createNameserver($nameserver): Nameserver
    {
        $responseObject = $this->post($this->endpoint('create'), get_defined_vars());
        if (!$responseObject->wasSuccess())
            throw new \LogicException('creation of nameserver was failed.');
        return (new Nameserver())->transformResponse($responseObject->getData());
    }

    public function deleteNameserver($nameserver): ResponseObject
    {
        $responseObject = $this->delete($this->endpoint('delete'), get_defined_vars());
        if (!$responseObject->wasSuccess())
            throw new \LogicException('nameserver cannot deleted.');
        return $responseObject;
    }

}
