<?php


namespace NicAPI\Manager\Objects;


class ResponseObject
{

    protected $clientTransactionId;
    protected $serverTransactionId;
    protected $data;
    protected $taskInfo;
    protected $status;
    protected $messages;

    /**
     * ResponseObject constructor.
     * @param int $serverTransactionId
     * @param $status
     * @param int $clientTransactionId
     * @param array $data
     * @param array $messages
     * @param null $taskInfo
     */
    public function __construct($serverTransactionId, $status, $clientTransactionId = 0, $data = [], $messages = [], $taskInfo = null)
    {
        $this->clientTransactionId = $clientTransactionId;
        $this->serverTransactionId = $serverTransactionId;
        $this->data = $data;
        $this->status = $status;
        $this->taskInfo = $taskInfo;
        $this->messages = $messages;
    }

    /**
     * @return mixed
     */
    public function getClientTransactionId()
    {
        return $this->clientTransactionId;
    }

    /**
     * @param mixed $clientTransactionId
     */
    public function setClientTransactionId($clientTransactionId)
    {
        $this->clientTransactionId = $clientTransactionId;
    }

    /**
     * @return mixed
     */
    public function getServerTransactionId()
    {
        return $this->serverTransactionId;
    }

    /**
     * @param mixed $serverTransactionId
     */
    public function setServerTransactionId($serverTransactionId)
    {
        $this->serverTransactionId = $serverTransactionId;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return null
     */
    public function getTaskInfo()
    {
        return $this->taskInfo;
    }

    /**
     * @param null $taskInfo
     */
    public function setTaskInfo($taskInfo)
    {
        $this->taskInfo = $taskInfo;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return null
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param null $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    public function wasSuccess()
    {
        return $this->status == 'success';
    }

    public function recordsTotal()
    {
        return $this->getData()->recordsFiltered;
    }

    public function recordsFiltered()
    {
        return $this->getData()->recordsFiltered;
    }

    public function recordsResult()
    {
        return $this->getData()->recordsFiltered;
    }

}