<?php
use Flywheel\Base;
use Flywheel\Debug\Profiler;

require __DIR__ .'/../bootstrap.php';
$globalCnf = require ROOT_PATH . '/config.cfg.php';
$config = Base::mergeArray( $globalCnf, require __DIR__ . '/../apps/Frontend/Config/main.cfg.php');

$env = Base::ENV_DEV;
$debug = false;

try {
    $app = Base::createWebApp($config, $env, $debug);
    $app->run();
} catch (\Exception $e) {
    \Flywheel\Exception::printExceptionInfo($e);
}