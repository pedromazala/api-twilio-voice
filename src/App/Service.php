<?php

namespace EMiolo\Twilio\App;

use EMiolo\Twilio\App\Type\PhoneNumber;
use EMiolo\Twilio\App\Util\Validations;
use Twilio\Rest\Client;

class Service
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct($sid, $token)
    {
        $http = null;
        $this->client = new Client($sid, $token);
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Validate if phone number is valid
     * @param $number
     * @return PhoneNumber|null
     */
    public function validatePhoneNumber($number)
    {
        return (new Validations($this))->phoneNumber($number);
    }
}