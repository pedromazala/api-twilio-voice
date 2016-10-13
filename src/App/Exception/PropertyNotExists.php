<?php

namespace EMiolo\Twilio\App;

use Exception;

class PropertyNotExists extends Exception
{
    /**
     * PropertyNotExists constructor.
     */
    public function __construct()
    {
        parent::__construct("Trying to access a invalid property");
    }
}