<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Unit\Service;

use OpenDxp\Bundle\DataHubBundle\Configuration;
use OpenDxp\Bundle\DataHubBundle\Service\CheckConsumerPermissionsService;
use Symfony\Component\HttpFoundation\Request;

beforeEach(function () {
    $this->configuration = $this->createStub(Configuration::class);
    $this->configuration->method('getSecurityConfig')->willReturn([
        'method' => Configuration::SECURITYCONFIG_AUTH_APIKEY,
        'apikey' => 'correct_key',
    ]);
});

function requestWithApiKeyHeader(string $header, string $apiKey, array $query = []): Request
{
    $request = new Request($query);
    $request->headers->set($header, $apiKey);

    return $request;
}

it('denies a request without an API key', function () {
    expect((new CheckConsumerPermissionsService())->performSecurityCheck(new Request(), $this->configuration))->toBeFalse();
});

it('denies a request with a wrong API key', function () {
    expect((new CheckConsumerPermissionsService())->performSecurityCheck(new Request(['apikey' => 'wrong_key']), $this->configuration))
        ->toBeFalse();
});

it('accepts the API key from the query', function () {
    expect((new CheckConsumerPermissionsService())->performSecurityCheck(new Request(['apikey' => 'correct_key']), $this->configuration))
        ->toBeTrue();
});

it('accepts the API key from the header', function (string $header) {
    expect((new CheckConsumerPermissionsService())->performSecurityCheck(requestWithApiKeyHeader($header, 'correct_key'), $this->configuration))
        ->toBeTrue();
})->with(['apikey', 'X-API-Key']);

it('takes the API key from the header before the one in the query', function () {
    $request = requestWithApiKeyHeader('apikey', 'correct_key', ['apikey' => 'wrong_key']);

    expect((new CheckConsumerPermissionsService())->performSecurityCheck($request, $this->configuration))->toBeTrue();
});
