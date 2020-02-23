<?php


namespace NicAPI\Manager\Handler;


use NicAPI\Manager\Handler\Domain\DomainHandler;
use NicAPI\Manager\Transformers\Domain\Domain;

class Manager
{

    protected $nicAPI;
    protected $domainHandler;

    public function __construct($nicAPI)
    {
        $this->nicAPI = $nicAPI;
        $this->setDomainHandler(new DomainHandler($nicAPI, 'domain'));
    }

    /**
     * @return mixed
     */
    public function getDomainHandler(): DomainHandler
    {
        return $this->domainHandler;
    }

    /**
     * @param mixed $domainHandler
     */
    public function setDomainHandler($domainHandler)
    {
        $this->domainHandler = $domainHandler;
    }

}