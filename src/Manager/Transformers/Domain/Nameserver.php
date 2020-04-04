<?php


namespace NicAPI\Manager\Transformers\Domain;


use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Transformers\ResponseTransformer;

/**
 * Class Country
 * @package NicAPI\Manager\Transformers\Nameserver
 * @property string id
 * @property string servername
 * @property array addresses
 * @property string created_at
 * @property string updated_at
 * @property string user
 */
class Nameserver extends ResponseTransformer
{

    use Helper;

    protected $nicAPI;
    protected $endpoint;

    protected $fillable = ['id', 'servername', 'addresses', 'created_at', 'updated_at', 'user'];

    /**
     * Nameserver constructor.
     * @param string $id
     * @param string $servername
     * @param array $addresses
     * @param string $created_at
     * @param string $updated_at
     * @param string $user
     */
    public function __construct(string $id = null, string $servername = null, array $addresses = null, string $created_at = null, string $updated_at = null, string $user = null)
    {
        foreach (get_defined_vars() as $key => $val) {
            $this->{$key} = $val;
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getServername(): string
    {
        return $this->servername;
    }

    /**
     * @return array
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

}
