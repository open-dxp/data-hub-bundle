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

namespace OpenDxp\Bundle\DataHubBundle\Tests\Feature\Service;

use OpenDxp\Bundle\DataHubBundle\Service\OutputCacheService;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * The cache backend is mocked, so a test sees what the service reads and writes.
 *
 * @return OutputCacheService&MockObject
 */
function outputCache(bool $enabled): OutputCacheService
{
    $container = test()->createStub(ContainerBagInterface::class);
    $container
        ->method('get')
        ->willReturn([
            'graphql' => [
                'output_cache_enabled' => $enabled,
                'output_cache_lifetime' => 25,
            ],
        ]);

    return test()
        ->getMockBuilder(OutputCacheService::class)
        ->setConstructorArgs([$container, new EventDispatcher()])
        ->onlyMethods(['loadFromCache', 'saveToCache'])
        ->getMock();
}

function graphQlRequest(): Request
{
    $request = Request::create(
        '/api',
        'POST',
        content: '{"query":"{ getProductCategoryListing { edges { node { fullpath } } } }"}',
    );
    $request->attributes->set('clientname', 'test-datahub-config');

    return $request;
}

it('returns nothing for a request it has not cached', function () {
    $cache = outputCache(enabled: true);
    $cache
        ->method('loadFromCache')
        ->willReturn(null);

    $response = $cache->load(graphQlRequest());

    expect($response)->toBeNull();
});

it('returns the cached response of a request', function () {
    $cached = new JsonResponse(['data' => 123]);
    $cache = outputCache(enabled: true);
    $cache
        ->method('loadFromCache')
        ->willReturn($cached);

    $response = $cache->load(graphQlRequest());

    expect($response)->toBe($cached);
});

it('caches a response while the cache is enabled', function () {
    $cache = outputCache(enabled: true);
    $cache
        ->expects($this->once())
        ->method('saveToCache');

    $cache->save(graphQlRequest(), new JsonResponse(['data' => 123]));
});

it('caches nothing while the cache is disabled', function () {
    $cache = outputCache(enabled: false);
    $cache
        ->expects($this->never())
        ->method('saveToCache');

    $cache->save(graphQlRequest(), new JsonResponse(['data' => 123]));
});

it('reads nothing while the cache is disabled', function () {
    $cache = outputCache(enabled: false);
    $cache
        ->expects($this->never())
        ->method('loadFromCache');

    $response = $cache->load(graphQlRequest());

    expect($response)->toBeNull();
});

it('skips the cache for a request that asks for no cache in debug mode', function () {
    $cache = outputCache(enabled: true);
    $cache
        ->expects($this->never())
        ->method('loadFromCache');
    $request = graphQlRequest();
    $request->query->set('opendxp_nocache', 'true');

    $response = $cache->load($request);

    expect($response)->toBeNull();
});
