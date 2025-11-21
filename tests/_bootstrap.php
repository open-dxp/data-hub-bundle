<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

use OpenDxp\Tests\Support\Util\Autoloader;

define('OPENDXP_TEST', true);

if (file_exists(__DIR__ . '/../vendor/autoload_runtime.php')) {
    include __DIR__ . '/../vendor/autoload_runtime.php';
    $opendxpTestDir = __DIR__ . '/../vendor/open-dxp/opendxp/tests';
} elseif (file_exists(__DIR__ . '/../../../../vendor/autoload_runtime.php')) {
    include __DIR__ . '/../../../../vendor/autoload_runtime.php';
    $opendxpTestDir = __DIR__ . '/../../../../vendor/open-dxp/opendxp/tests';
} elseif (getenv('OPENDXP_PROJECT_ROOT') != '' && file_exists(getenv('OPENDXP_PROJECT_ROOT') . '/vendor/autoload_runtime.php')) {
    include getenv('OPENDXP_PROJECT_ROOT') . '/vendor/autoload_runtime.php';
    $opendxpTestDir = getenv('OPENDXP_PROJECT_ROOT') . '/vendor/open-dxp/opendxp/tests';
} elseif (getenv('OPENDXP_PROJECT_ROOT') != '') {
    throw new \Exception('Invalid OpenDxp project root "' . getenv('OPENDXP_PROJECT_ROOT') . '"');
} else {
    throw new \Exception('Unknown configuration! OpenDxp project root not found, please set env variable OPENDXP_PROJECT_ROOT.');
}

$_SERVER['APP_ENV'] = 'test';
$_SERVER['APP_DEBUG'] = true;

$opendxpTestsSupportDir = $opendxpTestDir . '/Support';

//Pimcore 10 BC layer
if (!is_dir($opendxpTestsSupportDir)) {
    $opendxpTestsSupportDir = $opendxpTestDir . '/_support';
}

include $opendxpTestsSupportDir . '/Util/Autoloader.php';

\OpenDxp\Bootstrap::setProjectRoot();
\OpenDxp\Bootstrap::bootstrap();

//error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING);

Autoloader::addNamespace('OpenDxp\Tests', $opendxpTestsSupportDir); //Pimcore 10 BC layer
Autoloader::addNamespace('OpenDxp\Tests\Support', $opendxpTestsSupportDir);
Autoloader::addNamespace('OpenDxp\Model\DataObject', OPENDXP_CLASS_DIRECTORY . '/DataObject');
Autoloader::addNamespace('DataHubBundle\Tests', __DIR__);
Autoloader::addNamespace('DataHubBundle\Tests', __DIR__ . '/_support');

echo __DIR__ . '/_support';

if (!defined('TESTS_PATH')) {
    define('TESTS_PATH', __DIR__);
}

if (!defined('OPENDXP_TEST')) {
    define('OPENDXP_TEST', true);
}
