<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Infrastructure/Symfony/app/AppKernel.php';

$parameters = Yaml::parse(__DIR__ . '/../parameters.yml');
$symfony = $parameters['parameters']['symfony'];

if ($debug = (bool) $symfony['debug']) {
    Debug::enable();
}

$request = Request::createFromGlobals();
$kernel = new AppKernel($symfony['env'], $debug);
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
