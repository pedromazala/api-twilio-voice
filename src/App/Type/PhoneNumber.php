<?php

namespace EMiolo\Twilio\App\Type;

use EMiolo\Twilio\App\PropertyNotExists;

/**
 * @property string ddi
 * @property string number
 * @property string full_number
 * @property string country_code
 * @property string national_format
 * @property string carrier_name
 * @property string carrier_type
 */
class PhoneNumber
{
    protected $ddi;
    protected $number;
    protected $full_number;
    protected $country_code;
    protected $national_format;
    protected $carrier_name;
    protected $carrier_type;

    /**
     * @param mixed $ddi
     * @return PhoneNumber
     */
    public function setDdi($ddi)
    {
        $this->ddi = $ddi;
        return $this;
    }

    /**
     * @param mixed $number
     * @return PhoneNumber
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @param mixed $full_number
     * @return PhoneNumber
     */
    public function setFullNumber($full_number)
    {
        $this->full_number = $full_number;
        return $this;
    }

    /**
     * @param mixed $country_code
     * @return PhoneNumber
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
        return $this;
    }

    /**
     * @param mixed $national_format
     * @return PhoneNumber
     */
    public function setNationalFormat($national_format)
    {
        $this->national_format = $national_format;
        return $this;
    }

    /**
     * @param mixed $carrier_name
     * @return PhoneNumber
     */
    public function setCarrierName($carrier_name)
    {
        $this->carrier_name = $carrier_name;
        return $this;
    }

    /**
     * @param mixed $carrier_type
     * @return PhoneNumber
     */
    public function setCarrierType($carrier_type)
    {
        $this->carrier_type = $carrier_type;
        return $this;
    }

    /**
     * @param $key
     *
     * @return mixed
     *
     * @throws PropertyNotExists
     */
    public function __get($key)
    {
        if (property_exists(self::class, $key)) {
            return $this->$key;
        }

        throw new PropertyNotExists();
    }
}