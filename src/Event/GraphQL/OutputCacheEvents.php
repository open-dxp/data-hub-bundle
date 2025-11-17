<?php

declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL;

final class OutputCacheEvents
{
    /**
     * Fired to determine if a response should be cached.
     *
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\CachePreLoadEvent")
     *
     * @var string
     */
    const PRE_LOAD = 'opendxp.datahub.graphql.cache.preLoad';

    /**
     * Fired before the response is written to cache. Can be used to set or purge
     * data on the cached response.
     *
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\CachePreSaveEvent")
     *
     * @var string
     */
    const PRE_SAVE = 'opendxp.datahub.graphql.cache.preSave';
}
