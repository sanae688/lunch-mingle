<?php

require_once(__DIR__ . '/core/AutoLoader.php');

$loader = new AutoLoader();
$loader->registerDir(__DIR__ . '/controller');
$loader->registerDir(__DIR__ . '/core');
$loader->registerDir(__DIR__ . '/enum');
$loader->registerDir(__DIR__ . '/models');
$loader->register();
