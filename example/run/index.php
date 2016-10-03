<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "../../vendor/autoload.php";

$config = require "config.php";

$type = $config['type'];
$baseUrl = $config['baseUrl'];

$sid = $config['sid'];
$token = $config['token'];
$from = $config['from'];
$to = $config['to'];

if ($type === 'message') {

    if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
        ob_start();
        var_dump($_REQUEST);
        $a = ob_get_contents();
        ob_end_clean();

        file_put_contents('log/message/' . time() . '_' . uniqid() . '.log', $a);
        exit;
    }

    $sms = \EMiolo\Twilio\App\Message\Sms::get($sid, $token);

    $url = $baseUrl . "?callback";
    $params = [
        'StatusCallback' => $url
    ];
    $body = "Mensagem de teste da aplicação.";
    $sms->perform($to, $body, $from, $params);

} else if ($type === 'voice') {

    $call = \EMiolo\Twilio\App\Voice\Call::get($sid, $token);

    $url = $baseUrl . "?callback";
    if (!isset($_REQUEST['CallSid'])) {

        $performed = $call->perform($to, $url, $from);

        print $performed->sid;
    } else {

        $callFlow = new \EMiolo\Example\CallFlow($call);
        $callFlow->run();
    }
}