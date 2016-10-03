<?php

namespace EMiolo\Twilio\App\Voice\Pattern;

use EMiolo\Twilio\App\Voice\Exception\PerformedCallException;
use EMiolo\Twilio\App\Voice\Call;

abstract class CallFlow
{
    /**
     * @var Call
     */
    protected $call;

    /**
     * @param Call $call
     * @throws PerformedCallException
     */
    public final function setCall(Call $call)
    {
        if (is_null($call->getPerformedCall())) {
            throw new PerformedCallException();
        }

        $this->call = $call;
    }
}