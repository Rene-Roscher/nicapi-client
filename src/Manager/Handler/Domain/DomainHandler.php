<?php


namespace NicAPI\Manager\Handler\Domain;


use NicAPI\Manager\Handler\Handler;
use NicAPI\Manager\Objects\ResponseObject;
use NicAPI\Manager\Query\Query;
use NicAPI\Manager\Transformers\Domain\Domain;
use NicAPI\NicAPI;
use phpDocumentor\Reflection\DocBlock;

class DomainHandler extends Handler
{

    protected $targetObjectName = 'domains';
    protected $targetTransformerClass = Domain::class;

    public function serachByTLD($tld)
    {
        return $this->query()->where('name', 'LIKE', '%.'.$tld)->get();
    }

    public function deleteDomain($domainName, $date = 'now')
    {
        return $this->delete($this->endpoint('delete', [
            'domainName' => $domainName,
            'date' => $date
        ]));
    }

    public function order(Domain $domain, $authInfo = null, $years = 1)
    {
        foreach (['name', 'ownerC', 'adminC', 'techC', 'zoneC'] as $requirement) {
            if (!isset($domain->{$requirement})) throw new \LogicException($requirement.' not set in Domain Object.');
        }

        $response = $this->post($this->endpoint('create'), [
            'domainName' => $domain->getName(),
            'ownerC' => $domain->getOwnerC(),
            'adminC' => $domain->getAdminC(),
            'techC' => $domain->getTechC(),
            'zoneC' => $domain->getZoneC(),
            'ns1' => $domain->getNameservers()[0],
            'ns2' => $domain->getNameservers()[1],
            'ns3' => isset($domain->getNameservers()[2]) ? $domain->getNameservers()[2] : null,
            'ns4' => isset($domain->getNameservers()[3]) ? $domain->getNameservers()[3] : null,
            'ns5' => isset($domain->getNameservers()[4]) ? $domain->getNameservers()[4] : null,
            'transfer' => $authInfo,
            'years' => $years
        ])->getData()->domain;

        return (new Domain())->transformResponse($response);
    }

    public function generateAuthInfo($domainName): string
    {
        $response = $this->post($this->endpoint('authcode'), get_defined_vars());
        if (!$response->wasSuccess())
            throw new \LogicException('authInfo generation failed.');
        return $this->getDomainByName($domainName)->getAuthinfo();
    }

    public function getDomainByName($domainName): Domain
    {
        $entries = $this->query()->where('name', 'LIKE', $domainName)->get();
        return is_array($entries) ? $entries[0] : $entries;
    }

    public function checkAvailability($domainName): bool
    {
        $responseObject = $this->post($this->endpoint('check'), get_defined_vars());
        if (!$responseObject->wasSuccess())
            throw new \LogicException('availability check was failed.');
        return isset($responseObject->getData()->available) ? $responseObject->getData()->available : false;
    }

    public function editDomain($domainName, $ownerC, $adminC, $techC, $zoneC, $ns1, $ns2, $ns3 = null, $ns4 = null, $n5 = null, $user): Domain
    {
        $responseObject = $this->post($this->endpoint('edit'), get_defined_vars());
        if (!$responseObject->wasSuccess())
            throw new \LogicException('edit of domain was failed.');
        return (new Domain())->transformResponse($responseObject->getData());
    }

    public function allTlds()
    {
        return $this->get($this->endpoint('tlds'));
    }

    public function undeleteDomain($domainName): ResponseObject
    {
        $responseObject = $this->post($this->endpoint('undelete'), get_defined_vars());
        if (!$responseObject->wasSuccess())
            throw new \LogicException('delete of domain not unset');
        return $responseObject;
    }

    public function showDomain($domainName): Domain
    {
        $responseObject = $this->get($this->endpoint('show'), get_defined_vars());
        if (!$responseObject->wasSuccess())
            throw new \LogicException('domain cannot be found');
        return (new Domain())->transformResponse($responseObject->getData());
    }

    public function restoreDomain($domainName): Domain
    {
        $responseObject = $this->post($this->endpoint('restore'), get_defined_vars());
        if(!$responseObject->wasSuccess())
            throw new \LogicException('domain restore cannot be carried');
        return (new Domain())->transformResponse($responseObject->getData());
    }


}
