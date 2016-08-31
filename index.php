<?php

define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);

$protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$base_url = $_SERVER['HTTP_HOST'];
define('__BASE_URL__', $protocol . '://' . $base_url . '/');

require_once __ROOT__ . "vendor/autoload.php";

// M-Gov
$sid = "ACda019482cdeb6b0ce50e0ae710ce8af0";
$token = "c2590e5e650e7c1b2e21891196314b7c";
$from = "+551149502223";

// eMiolo
$sid = "AC207fb2661446d1c3d8c68150eeacf5ed";
$token = "ab2c982bd4b770029862741c2d298957";
$from = "+5532999743335";

$to = isset($_GET['to']) ? $_GET['to'] : '+5532999273553';

$client = new Services_Twilio($sid, $token, null);
$client->http->debug = true;

/**
 * @var $call Services_Twilio_InstanceResource
 */
$call = $client->account->calls->create(
    $from,
    $to,
    __BASE_URL__ . 'hello.php',
    [
        'FallbackUrl' => __BASE_URL__ . 'fallback.php',
        //'StatusCallback' => 'https://78bcaa03.ngrok.io/status.php',
    ]
);

\Acme\Debbuger::dd('performCall.html', $call);
print '<pre>';
var_dump($call->client);
print '<hr />';
var_dump($call->uri);
print '<hr />';
var_dump($call->getResourceName());
print '<hr />';
var_dump($call->sid);