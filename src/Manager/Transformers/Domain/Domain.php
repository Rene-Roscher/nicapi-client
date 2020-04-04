<?php


namespace NicAPI\Manager\Transformers\Domain;


use NicAPI\Manager\Query\Query;
use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Transformers\ResponseTransformer;
use NicAPI\NicAPI;

/**
 * @property integer id
 * @property string sld
 * @property string tld
 * @property string name
 * @property string ownerC
 * @property string adminC
 * @property string techC
 * @property string zoneC
 * @property string create
 * @property string expire
 * @property string delete
 * @property string suspended_at
 * @property string suspended_until
 * @property string authinfo
 * @property string status
 * @property string zone_id
 * @property string zone
 * @property string nameservers
 * @property string created_at
 * @property string updated_at
 * @property string user
 * @property array nameservers_pivot
 */
class Domain extends ResponseTransformer
{
    use Helper;

    protected $nicAPI;
    protected $endpoint;

    protected $fillable = ['id', 'sld', 'tld', 'name', 'ownerC', 'adminC', 'techC', 'zoneC', 'create', 'expire',
        'delete', 'suspended_at', 'suspended_at', 'suspended_until', 'authinfo', 'status', 'zone_id',
        'zone', 'nameservers', 'created_at', 'updated_at', 'user', 'nameservers_pivot'];

    public function __construct($sld = null, $tld = null, $ownerC = null, $adminC = null, $techC = null, $zoneC = null, array $nameservers = [])
    {
        $this->sld = $sld;
        $this->sld = $sld;
        $this->name = $sld.'.'.$tld;
        $this->tld = $tld;
        $this->ownerC = $ownerC;
        $this->adminC = $adminC;
        $this->techC = $techC;
        $this->zoneC = $zoneC;
        $this->nameservers = $nameservers;
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
    public function getSld(): string
    {
        return $this->sld;
    }

    /**
     * @return string
     */
    public function getTld(): string
    {
        return $this->tld;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOwnerC(): string
    {
        return $this->ownerC;
    }

    /**
     * @return string
     */
    public function getAdminC(): string
    {
        return $this->adminC;
    }

    /**
     * @return string
     */
    public function getTechC(): string
    {
        return $this->techC;
    }

    /**
     * @return string
     */
    public function getZoneC(): string
    {
        return $this->zoneC;
    }

    /**
     * @return string
     */
    public function getCreate(): string
    {
        return $this->create;
    }

    /**
     * @return string
     */
    public function getExpire(): string
    {
        return $this->expire;
    }

    /**
     * @return string
     */
    public function getDelete(): string
    {
        return $this->delete;
    }

    /**
     * @return string
     */
    public function getSuspendedAt(): string
    {
        return $this->suspended_at;
    }

    /**
     * @return string
     */
    public function getSuspendedUntil(): string
    {
        return $this->suspended_until;
    }

    /**
     * @return string
     */
    public function getAuthinfo(): string
    {
        return $this->authinfo;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getZoneId(): string
    {
        return $this->zone_id;
    }

    /**
     * @return string
     */
    public function getZone(): string
    {
        return $this->zone;
    }

    /**
     * @return string
     */
    public function getNameservers(): array
    {
        return $this->nameservers;
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
    public function getNameserversPivot(): array
    {
        return $this->nameservers_pivot;
    }

}
