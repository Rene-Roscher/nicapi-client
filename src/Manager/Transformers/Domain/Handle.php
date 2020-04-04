<?php


namespace NicAPI\Manager\Transformers\Domain;


use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Transformers\ResponseTransformer;

/**
 * @property integer id
 * @property string handle
 * @property string type
 * @property string sex
 * @property string firstname
 * @property string lastname
 * @property string organisation
 * @property string street
 * @property string number
 * @property string postcode
 * @property string city
 * @property string region
 * @property string country
 * @property string email
 * @property string user
 * @property string created_at
 * @property string updated_at
 */
class Handle extends ResponseTransformer
{

    use Helper;

    protected $nicAPI;
    protected $endpoint;

    protected $fillable = ['id', 'handle', 'type', 'sex', 'firstname', 'lastname', 'organisation', 'street', 'number', 'postcode',
        'city', 'region', 'country', 'email', 'user', 'created_at', 'updated_at'];

    public function __construct($firstname = null, $lastname = null, $sex = null, $street = null, $number = null, $postcode = null, $city = null, $region = null, $country = null, $email = null, $type = null, $organisation = null)
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
    public function getHandle(): string
    {
        return $this->handle;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getOrganisation(): string
    {
        return $this->organisation;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
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

}
