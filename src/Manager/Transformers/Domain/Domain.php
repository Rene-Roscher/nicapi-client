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

    public function __construct(NicAPI $nicAPI, $endpoint)
    {
        $this->nicAPI = $nicAPI;
        $this->endpoint = $endpoint;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSld(): string
    {
        return $this->sld;
    }

    /**
     * @param string $sld
     */
    public function setSld(string $sld)
    {
        $this->sld = $sld;
    }

    /**
     * @return string
     */
    public function getTld(): string
    {
        return $this->tld;
    }

    /**
     * @param string $tld
     */
    public function setTld(string $tld)
    {
        $this->tld = $tld;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getOwnerC(): string
    {
        return $this->ownerC;
    }

    /**
     * @param string $ownerC
     */
    public function setOwnerC(string $ownerC)
    {
        $this->ownerC = $ownerC;
    }

    /**
     * @return string
     */
    public function getAdminC(): string
    {
        return $this->adminC;
    }

    /**
     * @param string $adminC
     */
    public function setAdminC(string $adminC)
    {
        $this->adminC = $adminC;
    }

    /**
     * @return string
     */
    public function getTechC(): string
    {
        return $this->techC;
    }

    /**
     * @param string $techC
     */
    public function setTechC(string $techC)
    {
        $this->techC = $techC;
    }

    /**
     * @return string
     */
    public function getZoneC(): string
    {
        return $this->zoneC;
    }

    /**
     * @param string $zoneC
     */
    public function setZoneC(string $zoneC)
    {
        $this->zoneC = $zoneC;
    }

    /**
     * @return string
     */
    public function getCreate(): string
    {
        return $this->create;
    }

    /**
     * @param string $create
     */
    public function setCreate(string $create)
    {
        $this->create = $create;
    }

    /**
     * @return string
     */
    public function getExpire(): string
    {
        return $this->expire;
    }

    /**
     * @param string $expire
     */
    public function setExpire(string $expire)
    {
        $this->expire = $expire;
    }

    /**
     * @return string
     */
    public function getDelete(): string
    {
        return $this->delete;
    }

    /**
     * @param string $delete
     */
    public function setDelete(string $delete)
    {
        $this->delete = $delete;
    }

    /**
     * @return string
     */
    public function getSuspendedAt(): string
    {
        return $this->suspended_at;
    }

    /**
     * @param string $suspended_at
     */
    public function setSuspendedAt(string $suspended_at)
    {
        $this->suspended_at = $suspended_at;
    }

    /**
     * @return string
     */
    public function getSuspendedUntil(): string
    {
        return $this->suspended_until;
    }

    /**
     * @param string $suspended_until
     */
    public function setSuspendedUntil(string $suspended_until)
    {
        $this->suspended_until = $suspended_until;
    }

    /**
     * @return string
     */
    public function getAuthinfo(): string
    {
        return $this->authinfo;
    }

    /**
     * @param string $authinfo
     */
    public function setAuthinfo(string $authinfo)
    {
        $this->authinfo = $authinfo;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getZoneId(): string
    {
        return $this->zone_id;
    }

    /**
     * @param string $zone_id
     */
    public function setZoneId(string $zone_id)
    {
        $this->zone_id = $zone_id;
    }

    /**
     * @return string
     */
    public function getZone(): string
    {
        return $this->zone;
    }

    /**
     * @param string $zone
     */
    public function setZone(string $zone)
    {
        $this->zone = $zone;
    }

    /**
     * @return string
     */
    public function getNameservers(): string
    {
        return $this->nameservers;
    }

    /**
     * @param string $nameservers
     */
    public function setNameservers(string $nameservers)
    {
        $this->nameservers = $nameservers;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt(string $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getNameserversPivot(): array
    {
        return $this->nameservers_pivot;
    }

    /**
     * @param array $nameservers_pivot
     */
    public function setNameserversPivot(array $nameservers_pivot)
    {
        $this->nameservers_pivot = $nameservers_pivot;
    }

    public function query(): Query
    {
        return new Query($this->nicAPI, $this->endpoint);
    }

}