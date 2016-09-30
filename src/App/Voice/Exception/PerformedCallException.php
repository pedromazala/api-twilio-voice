<?php

namespace EMiolo\Twilio\App\Voice\Exception;

use \Exception;

class PerformedCallException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            "You cannot start a flow without a performed call",
            1
        );
    }
}