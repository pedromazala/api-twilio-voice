<?php

namespace EMiolo\Twilio\App\Util;

use EMiolo\Twilio\App\Service;
use EMiolo\Twilio\App\Type\PhoneNumber;
use Exception;
use Twilio\Rest\Lookups;

class Validations
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * Validations constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get validated phone number
     *
     * @param $number
     * @return PhoneNumber|null
     */
    public function phoneNumber($number)
    {
        $phoneNumber = null;

        try {

            $lookup = new Lookups($this->service->getClient());

            $number = $lookup
                ->phoneNumbers($number)
                ->fetch([
                    "Type" => "carrier"
                ]);
            $number_phone = preg_replace('/[^0-9]/i', '', $number->nationalFormat);
            $number_ddi   = str_replace($number_phone, '', $number->phoneNumber);

            $phoneNumber = new PhoneNumber();

            $phoneNumber
                ->setDdi($number_ddi)
                ->setNumber($number_phone)
                ->setFullNumber($number->phoneNumber)
                ->setCountryCode($number->countryCode)
                ->setNationalFormat($number->nationalFormat)
                ->setCarrierName($number->carrier['name'])
                ->setCarrierType($number->carrier['type']);

        } catch (Exception $ex) {

        }

        return $phoneNumber;
    }
}