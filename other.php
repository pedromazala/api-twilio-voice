<?php

define('__ROOT__', __DIR__ . DIRECTORY_SEPARATOR);

$protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$base_url = $_SERVER['HTTP_HOST'];
define('__BASE_URL__', $protocol . '://' . $base_url . '/');

require_once __ROOT__ . "vendor/autoload.php";

\Acme\Debbuger::dd('other.html', $_REQUEST);

// if the caller pressed anything but 1 send them back
if (!in_array($_REQUEST['Digits'], [1, 2])) {
    header("Location: hello.php");
    die;
}

$voiceParameters = 'language="pt-BR" voice="man"';

// the user pressed 1, connect the call to 310-555-1212
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
switch ($_REQUEST['Digits']) {
    case 1: {
        ?>
        <Response>
            <Play>http://demo.twilio.com/hellomonkey/monkey.mp3</Play>
            <Say <?= $voiceParameters ?>>A verdade é que, infelizmente, não temos um macaco de verdade.</Say>
        </Response>
        <?php
        break;
    }
    case 2: {
        ?>
        <Response>
            <Play><?= __BASE_URL__; ?>song.mp3</Play>
        </Response>
        <?php
        break;
    }
}