<?php


namespace NicAPI\Manager\Transformers\Domain;


use NicAPI\Manager\Traits\Helper;
use NicAPI\Manager\Transformers\ResponseTransformer;

/**
 * Class Country
 * @package NicAPI\Manager\Transformers\Domain
 * @property string code
 * @property string title
 */
class Country extends ResponseTransformer
{

    use Helper;

    protected $nicAPI;
    protected $endpoint;

    protected $fillable = ['code', 'title'];

    /**
     * Country constructor.
     */
    public function __construct($code = null, $title = null)
    {
        foreach (get_defined_vars() as $key => $val) {
            $this->{$key} = $val;
        }
    }

    /**
     * @return null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

}
