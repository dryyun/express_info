<?php
/**
 * User: dryyun
 * Time: 2015/10/19 16:55
 * File: test.php
 */
require '../vendor/autoload.php';

$key = '***';
$a = new Dryyun\ExpressInfo\Handler\JuheKuaidiHandler($key);

$f=$a->getExpressInfo('sf','210180976757');
$aca=$a->formatExpressData($f);
print_r($aca);
