<?php
/**
 * Created by PhpStorm.
 * User: emiolo
 * Date: 02/09/16
 * Time: 08:34
 */

namespace EMiolo\Twilio\App\Pattern;

use EMiolo\Twilio\App\Call;
use EMiolo\Twilio\App\Exception\PerformedCallException;

abstract class CallFlow
{
    /**
     * @var Call
     */
    protected $call;

    /**
     * CallFlow constructor.
     *
     * @param Call $call
     * @throws PerformedCallException
     */
    public final function __construct(Call $call)
    {
        if (is_null($call->getPerformedCall())) {
            throw new PerformedCallException();
            die();
        }

        $this->call = $call;

        $this->run();
    }

    /**
     * Método que é chamado logo após a construção do objeto.
     *
     * @return mixed
     */
    public abstract function run();
}