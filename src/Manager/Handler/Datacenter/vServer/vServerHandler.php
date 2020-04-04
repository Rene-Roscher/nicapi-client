<?php


namespace NicAPI\Manager\Handler\Datacenter\vServer;


use NicAPI\Manager\Handler\Handler;
use NicAPI\Manager\Transformers\Datacenter\vServer\vServer;
use NicAPI\Manager\Transformers\Domain\Country;
use NicAPI\Manager\Transformers\Domain\Domain;

class vServerHandler extends Handler
{

    protected $targetObjectName = 'vservers';
    protected $targetTransformerClass = vServer::class;

    public function showVServer($vServerId)
    {
        $responseObject = $this->get($this->endpoint($vServerId));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('vserver was not found.');
        return (new vServer())->transformResponse($responseObject);
    }

    public function deleteVServer($vServerId)
    {
        $responseObject = $this->delete($this->endpoint($vServerId . '/delete'));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot delete the vm');
        return true;
    }

    public function getBackups($vServerId)
    {
        $responseObject = $this->get($this->endpoint($vServerId . '/backups'));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot get backups of the vm');
        return $responseObject;
    }

    public function createBackup($vServerId)
    {
        $responseObject = $this->post($this->endpoint($vServerId . '/createBackup'));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot create backup of vm');
        return $responseObject;
    }

    public function restoreBackup($vServerId, $backupId)
    {
        $responseObject = $this->post($this->endpoint('backups/' . $backupId . '/restore'));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot restoring the backup');
        return $responseObject;
    }

    public function deleteBackup($vServerId, $backupId)
    {
        $responseObject = $this->delete($this->endpoint('backups/' . $backupId . '/delete'));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot delete the vm');
        return true;
    }

    public function getGraph($vServerId, $cf, $timeframe)
    {
        $responseObject = $this->get($this->endpoint($vServerId . '/graph'), [
            'timeframe' => $timeframe,
            'cf' => $cf
        ]);
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot get the vm rrd');
        return $responseObject;
    }

    public function getVNC($vServerId)
    {
        $responseObject = $this->get($this->endpoint($vServerId . '/graph'));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot get the vm rrd');
        return $responseObject;
    }

    public function reinstall($vServerId, $vServerTemplate = 'DEBIAN_9', $password)
    {
        $responseObject = $this->post($this->endpoint($vServerId . '/reinstall'), [
            'template' => $vServerTemplate,
            'password' => $password
        ]);
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot reinstall the vm');
        return $responseObject;
    }

    function performAction($vServerId, $action)
    {
        $responseObject = $this->get($this->endpoint($vServerId . '/' . $action));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot perform action on the vm');
        return $responseObject;
    }

    public function restart($vServerId)
    {
        return $this->performAction($vServerId, 'restart');
    }

    public function stop($vServerId)
    {
        return $this->performAction($vServerId, 'stop');
    }

    public function shutdown($vServerId)
    {
        return $this->performAction($vServerId, 'shutdown');
    }

    public function start($vServerId)
    {
        return $this->performAction($vServerId, 'start');
    }

    function status($vServerId)
    {
        $responseObject = $this->get($this->endpoint($vServerId . '/status'));
        if (!$responseObject->wasSuccess())
            throw new \LogicException('cannot get vm status');
        return $responseObject;
    }

    public function isOnline($vServerId)
    {
        return $this->status($vServerId)->getData()->status->status == 'online';
    }

}
