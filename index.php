<?php
define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);

require_once "vendor/autoload.php";

use EMiolo\Twilio\App;
use EMiolo\Twilio\App\Call;
use EMiolo\Twilio\App\Service;
use EMiolo\Twilio\Helper\Debugger;

App::start();

$params = App::getParameters();
$route = array_shift($params);

$config = require 'config/eMiolo.php';

$service = new Service($config['sid'], $config['token']);
$call = new Call($service);

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

/*    print '<pre>';
    var_dump($performedCall->client);
    print '<hr />';
    var_dump($performedCall->uri);
    print '<hr />';
    var_dump($performedCall->getResourceName());
    print '<hr />';*/
    var_dump($performedCall->sid);

    Debugger::dd('performCall.html', $performedCall);

} else if (in_array($route, ['hello', 'read', 'events', 'fallback'], true)) {

    $callSid = $_REQUEST['CallSid'];
    $call->setPerformedCall($callSid);

    $CallFlowClass = $config['usage'] . 'CallFlow';

    $flow = new $CallFlowClass($call);
    die();

    switch ($route) {
        case 'hello': {
            break;
        }
        case 'read': {
            break;
        }
        case 'events': {
            break;
        }
        case 'fallback': {
            break;
        }
        default: {
            die ("Provavelmente, foi adicionada uma entrada nas rotas disponíveis, mas ela não está sendo utilizada.");
            break;
        }
    }

} else {
    die("Rota desconhecida.");
}