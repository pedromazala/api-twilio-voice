<?php

define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);

$protocol = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : 'http';
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

$client = new Services_Twilio($sid, $token, null);
$client->http->debug = true;

$sid = $_REQUEST['CallSid'];
$status_path = implode(DIRECTORY_SEPARATOR, [__ROOT__, 'log', 'status', $sid]);
@mkdir($status_path, 0777, true);

$status_file = implode(DIRECTORY_SEPARATOR, ['status', $sid, $_REQUEST['CallStatus'] . '.html']);
\EMiolo\Twilio\Helper\Debugger::dd($status_file, $_REQUEST);