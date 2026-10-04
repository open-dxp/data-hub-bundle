<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Feature\Service;

use OpenDxp\Bundle\DataHubBundle\Service\OutputCacheService;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @return OutputCacheService&MockObject
 */
function outputCache(bool $enabled): OutputCacheService
{
    $container = test()->createStub(ContainerBagInterface::class);
    $container->method('get')->willReturn(['graphql' => ['output_cache_enabled' => $enabled, 'output_cache_lifetime' => 25]]);

    return test()->getMockBuilder(OutputCacheService::class)
        ->setConstructorArgs([$container, new EventDispatcher()])
        ->onlyMethods(['loadFromCache', 'saveToCache'])
        ->getMock();
}

function graphQlRequest(): Request
{
    $request = Request::create('/api', 'POST', content: '{"query":"{ getProductCategoryListing { edges { node { fullpath } } } }"}');
    $request->attributes->set('clientname', 'test-datahub-config');

    return $request;
}

it('returns nothing for a request it has not cached', function () {
    $cache = outputCache(true);
    $cache->method('loadFromCache')->willReturn(null);

    expect($cache->load(graphQlRequest()))->toBeNull();
});

it('returns the cached response of a request', function () {
    $response = new JsonResponse(['data' => 123]);
    $cache = outputCache(true);
    $cache->method('loadFromCache')->willReturn($response);

    expect($cache->load(graphQlRequest()))->toBe($response);
});

it('caches a response while the cache is enabled', function () {
    $cache = outputCache(true);
    $cache->expects($this->once())->method('saveToCache');

    $cache->save(graphQlRequest(), new JsonResponse(['data' => 123]));
});

it('neither caches nor reads while the cache is disabled', function () {
    $cache = outputCache(false);
    $cache->expects($this->never())->method('saveToCache');
    $cache->expects($this->never())->method('loadFromCache');

    $cache->save(graphQlRequest(), new JsonResponse(['data' => 123]));

    expect($cache->load(graphQlRequest()))->toBeNull();
});

it('skips the cache for a request that asks for no cache in debug mode', function () {
    $cache = outputCache(true);
    $cache->expects($this->never())->method('loadFromCache');

    $request = graphQlRequest();
    $request->query->set('opendxp_nocache', 'true');

    expect($cache->load($request))->toBeNull();
});
