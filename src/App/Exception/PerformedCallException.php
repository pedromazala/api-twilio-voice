<?php
/**
 * Created by PhpStorm.
 * User: emiolo
 * Date: 02/09/16
 * Time: 09:34
 */

namespace EMiolo\Twilio\App\Exception;


class PerformedCallException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            "You cannot start a flow without a performed call",
            1
        );
    }
}