<?php


namespace NicAPI\Manager\Handler\Domain;


use NicAPI\Manager\Handler\Handler;
use NicAPI\Manager\Objects\ResponseObject;
use NicAPI\Manager\Transformers\Domain\Domain;
use NicAPI\Manager\Transformers\Domain\Handle;

class DomainHandleHandler extends Handler
{

    protected $targetObjectName = 'handles';
    protected $targetTransformerClass = Handle::class;

    public function create($type, $firstname, $lastname, $sex, $street, $number, $postcode, $city, $region, $country, $email, $organisation)
    {
        $responseObject = $this->post($this->endpoint('create'), get_defined_vars());
        if(!$responseObject->wasSuccess())
            throw new \LogicException('creation of handle was failed.');
        return new Handle($firstname, $lastname, $sex, $street, $number, $postcode, $city, $region, $country, $email, $type, $organisation);
    }

    public function editHandle($handle, $street, $number, $postcode, $city, $region, $country, $email): ResponseObject
    {
        $responseObject = $this->delete($this->endpoint('edit'), get_defined_vars());
        if (!$responseObject->wasSuccess())
            throw new \LogicException('edit of handle was failed.');
        return $responseObject;
    }

    public function deleteHandle($handle): ResponseObject
    {
        return $this->delete($this->endpoint('delete'), get_defined_vars());
    }

    public function showHandle($handle)
    {
        $responseObject = $this->get($this->endpoint('show'), get_defined_vars());
        if(!$responseObject->wasSuccess())
            throw new \LogicException('the serached handle was not found.');
        return (new Handle())->transformResponse($responseObject->getData());
    }

}
