<?php
//Load Composer's auto loader
require_once realpath(__DIR__ . '/vendor/autoload.php');

//load .env
$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();