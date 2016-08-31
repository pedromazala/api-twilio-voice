<?php
/**
 * Created by PhpStorm.
 * User: emiolo
 * Date: 29/08/16
 * Time: 17:38
 */

namespace Acme;


class Debbuger
{
    public static function dd($filename, ...$debug) {
        ob_start();

        print '<pre>' . PHP_EOL;
        var_dump($debug) . PHP_EOL;
        print '</pre>' . PHP_EOL;

        $contents = ob_get_contents();
        ob_end_clean();

        file_put_contents(__ROOT__ . 'log' . DIRECTORY_SEPARATOR . $filename, $contents);
    }
}