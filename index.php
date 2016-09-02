<?php
define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);

require_once "vendor/autoload.php";

use EMiolo\Twilio\App;
use EMiolo\Twilio\App\Call;
use EMiolo\Twilio\App\Service;
use EMiolo\Twilio\Helper\Debugger;

App::start();

$config = require 'config/eMiolo.php';

$service = new Service($config['sid'], $config['token']);
$call = new Call($service);

$params = App::getParameters();
if (file_exists(__ROOT__ . implode(DIRECTORY_SEPARATOR, $params))) {

    /** @noinspection PhpIncludeInspection */
    require_once (__ROOT__ . implode(DIRECTORY_SEPARATOR, $params));
} else {
    $route = array_shift($params);

    /*
     * $call também poderia ser instanciada da seguinte forma:
     * $call = Call::getCall($config['sid'], $config['token']);
     */

    if ($route === 'call') {

        $to = array_shift($params);
        if (strlen($to) == 0) {
            die('O destinatário não pode ser vazio.');
        }

        $url = __BASE_URL__ . 'hello/';

        $performedCall = $call->perform($to, $url, $config['from']);

        var_dump($performedCall->sid);

        Debugger::dd('performCall.html', $performedCall);

    } else if (in_array($route, ['hello', 'read'], true)) {

        //$call->setPerformedCall($_REQUEST['CallSid']);

        $CallFlowClass = $config['usage'] . 'CallFlow';

        $flow = new $CallFlowClass($call);

    } else if (in_array($route, ['events', 'fallback'], true)) {

    } else {
        die("Rota desconhecida.");
    }
}
/*
print '<pre>';
var_dump($performedCall->client);
print '<hr />';
var_dump($performedCall->uri);
print '<hr />';
var_dump($performedCall->getResourceName());
print '<hr />';
*/