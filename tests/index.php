<?php

require 'autoload.php';
require '../vendor/autoload.php';

$main = new Meroseo\Sdk\Main();

$result = $main->authenticate('62c1c38933a4d', 'umacena');

print 'authenticate result is : \n\n';

var_dump($result);

print '\n\n\n\n';

$result = $main->page->create(['url' => 'xico finisho!!']);

print 'result is : \n\n';

print_r($result);

print '\n\n\n\n';
