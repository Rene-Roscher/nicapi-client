<?php


namespace NicAPI\Tests;


use NicAPI\NicAPI;

class NicAPIFacade
{

    public function boot()
    {
        $nicAPI = new NicAPI('');
        $nicAPI->getManager()->getDomainHandler()->getList();
    }

}