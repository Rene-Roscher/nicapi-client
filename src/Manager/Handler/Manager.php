<?php


namespace NicAPI\Manager\Handler;


use NicAPI\Manager\Handler\Datacenter\vServer\vServerHandler;
use NicAPI\Manager\Handler\Domain\CountryHandler;
use NicAPI\Manager\Handler\Domain\DomainHandleHandler;
use NicAPI\Manager\Handler\Domain\DomainHandler;
use NicAPI\Manager\Handler\Domain\NameserverHandler;
use NicAPI\Manager\Transformers\Domain\Domain;

class Manager
{

    protected $nicAPI;
    protected $domainHandler;
    protected $countryHandler;
    protected $domainHandleHandler;
    protected $domainNameserverHandler;

    protected $vServerHandler;

    public function __construct($nicAPI)
    {
        $this->nicAPI = $nicAPI;
        $this->domainHandler = new DomainHandler($nicAPI, 'domain/domains');
        $this->countryHandler = new CountryHandler($nicAPI, 'domain/handles/countries');
        $this->domainHandleHandler = new DomainHandleHandler($nicAPI, 'domain/handles');
        $this->domainNameserverHandler = new NameserverHandler($nicAPI, 'domain/nameservers');
        $this->vServerHandler = new vServerHandler($nicAPI, 'datacenter/vservers');
    }

    /**
     * @return mixed
     */
    public function getNicAPI()
    {
        return $this->nicAPI;
    }

    /**
     * @return DomainHandler
     */
    public function getDomainHandler(): DomainHandler
    {
        return $this->domainHandler;
    }

    /**
     * @return CountryHandler
     */
    public function getCountryHandler(): CountryHandler
    {
        return $this->countryHandler;
    }

    /**
     * @return DomainHandleHandler
     */
    public function getDomainHandleHandler(): DomainHandleHandler
    {
        return $this->domainHandleHandler;
    }

    /**
     * @return NameserverHandler
     */
    public function getDomainNameserverHandler(): NameserverHandler
    {
        return $this->domainNameserverHandler;
    }

    /**
     * @return vServerHandler
     */
    public function getVServerHandler(): vServerHandler
    {
        return $this->vServerHandler;
    }

}
