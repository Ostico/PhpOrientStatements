<?php
error_reporting( -1 );
date_default_timezone_set( 'UTC' );
$loader = require __DIR__ . "/../vendor/autoload.php";
$loader->addPsr4( 'PhpOrient\\', __DIR__ . '/PhpOrientStatements' );
$loader->addPsr4( 'PhpOrient\\', __DIR__ . "/../src/PhpOrientStatements" );
