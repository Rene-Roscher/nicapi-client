<?php

namespace NicAPI\Manager\Transformers\Datacenter\vServer;

use NicAPI\Manager\Objects\ResponseObject;
use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Transformers\ResponseTransformer;

/**
 * Class vServer
 * @package NicAPI\Manager\Transformers\Datacenter\vServer
 * @property int $id
 * @property string $title
 * @property string $hostname
 * @property string $type
 * @property int $memory
 * @property int $cores
 * @property string $template
 * @property int $disk
 * @property boolean $start_at_boot
 * @property string $traffic
 * @property string $max_backups
 * @property string $max_scheduled_tasks
 * @property string $password
 * @property string $reseller_accounting
 * @property string $created_at
 * @property string $updated_at
 * @property string $user
 * @property array $addresses
 * @property int $addresses_v4
 * @property string $networks
 */
class vServer extends ResponseTransformer
{

    use Helper;

    protected $nicAPI;
    protected $endpoint;

    protected $fillable = ['id', 'title', 'hostname', 'type', 'memory', 'cores', 'template', 'disk', 'start_at_boot',
        'traffic', 'max_backups', 'max_scheduled_tasks', 'password', 'reseller_accounting', 'created_at', 'updated_at',
        'user', 'addresses', 'addresses_v4', 'networks'];

    /**
     * vServer constructor.
     * @param int $id
     * @param string $title
     * @param string $hostname
     * @param string $type
     * @param int $memory
     * @param int $cores
     * @param string $template
     * @param int $disk
     * @param bool $start_at_boot
     * @param string $traffic
     * @param string $max_backups
     * @param string $max_scheduled_tasks
     * @param string $password
     * @param string $reseller_accounting
     * @param string $created_at
     * @param string $updated_at
     * @param string $user
     * @param array $addresses
     * @param int $addresses_v4
     * @param string $networks
     */
    public function __construct(int $id = null, string $title = null, string $hostname = null, string $type = null
        , int $memory = null, int $cores = null, string $template = null, int $disk = null, bool $start_at_boot = null
        , string $traffic = null, string $max_backups = null, string $max_scheduled_tasks = null, string $password = null
        , string $reseller_accounting = null, string $created_at = null, string $updated_at = null, string $user = null
        , array $addresses = null, int $addresses_v4 = null, string $networks = null)
    {
        foreach (get_defined_vars() as $key => $val) {
            $this->{$key} = $val;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getMemory(): int
    {
        return $this->memory;
    }

    /**
     * @return int
     */
    public function getCores(): int
    {
        return $this->cores;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return int
     */
    public function getDisk(): int
    {
        return $this->disk;
    }

    /**
     * @return bool
     */
    public function isStartAtBoot(): bool
    {
        return $this->start_at_boot;
    }

    /**
     * @return string
     */
    public function getTraffic(): string
    {
        return $this->traffic;
    }

    /**
     * @return string
     */
    public function getMaxBackups(): string
    {
        return $this->max_backups;
    }

    /**
     * @return string
     */
    public function getMaxScheduledTasks(): string
    {
        return $this->max_scheduled_tasks;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getResellerAccounting(): string
    {
        return $this->reseller_accounting;
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

    /**
     * @return array
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @return int
     */
    public function getAddressesV4(): int
    {
        return $this->addresses_v4;
    }

    /**
     * @return string
     */
    public function getNetworks(): string
    {
        return $this->networks;
    }

}
