<?php

require 'autoload.php';
require '../vendor/autoload.php';

require '../src/Main.php';
require '../src/Modules/Generic.php';
require '../src/Modules/Page.php';
require '../src/Modules/Auth.php';
require '../src/Modules/Event.php';
require '../src/Modules/User.php';

$main = new Meroseo\Sdk\Main();

$result = $main->authenticate('62c1c38933a4d', 'umacena');

print 'authenticate result is : \n\n';

var_dump($result);

print '\n\n\n\n';

$result = $main->page->create(['url' => 'xico finisho!!']);

print 'result is : \n\n';

print_r($result);

print '\n\n\n\n';
