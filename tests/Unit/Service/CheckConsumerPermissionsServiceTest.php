<?php

declare(strict_types=1);

/**
 * OpenDXP
 *
 * This source file is licensed under the GNU General Public License version 3 (GPLv3).
 *
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (https://pimcore.com)
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\DataHubBundle\Tests\Unit\Service;

use OpenDxp\Bundle\DataHubBundle\Configuration;
use OpenDxp\Bundle\DataHubBundle\Service\CheckConsumerPermissionsService;
use Symfony\Component\HttpFoundation\Request;

beforeEach(function () {
    $this->configuration = $this->createStub(Configuration::class);
    $this->configuration
        ->method('getSecurityConfig')
        ->willReturn([
            'method' => Configuration::SECURITYCONFIG_AUTH_APIKEY,
            'apikey' => 'correct_key',
        ]);
    $this->permissions = new CheckConsumerPermissionsService();
});

/**
 * @param array<string, string> $query
 */
function requestWithApiKeyHeader(string $header, string $apiKey, array $query): Request
{
    $request = new Request($query);
    $request->headers->set($header, $apiKey);

    return $request;
}

it('denies a request without an API key', function () {
    $permitted = $this->permissions->performSecurityCheck(new Request(), $this->configuration);

    expect($permitted)->toBeFalse();
});

it('denies a request with a wrong API key', function () {
    $request = new Request(['apikey' => 'wrong_key']);

    $permitted = $this->permissions->performSecurityCheck($request, $this->configuration);

    expect($permitted)->toBeFalse();
});

it('accepts the API key from the query', function () {
    $request = new Request(['apikey' => 'correct_key']);

    $permitted = $this->permissions->performSecurityCheck($request, $this->configuration);

    expect($permitted)->toBeTrue();
});

it('accepts the API key from the header', function (string $header) {
    $request = requestWithApiKeyHeader($header, 'correct_key', []);

    $permitted = $this->permissions->performSecurityCheck($request, $this->configuration);

    expect($permitted)->toBeTrue();
})->with([
    'named apikey' => ['apikey'],
    'named X-API-Key' => ['X-API-Key'],
]);

it('takes the API key from the header before the one in the query', function () {
    $request = requestWithApiKeyHeader('apikey', 'correct_key', ['apikey' => 'wrong_key']);

    $permitted = $this->permissions->performSecurityCheck($request, $this->configuration);

    expect($permitted)->toBeTrue();
});
