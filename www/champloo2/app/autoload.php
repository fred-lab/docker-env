<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('FOS','vendor/FOS/UserBundle');

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
