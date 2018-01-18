<?php

require_once 'app/bootstrap/bootstrap.php';

use vendor\core\Router;


$loader = new Loader();

spl_autoload_register([$loader, 'loadClass']);




$Routs = new Router();
$Routs->up();












