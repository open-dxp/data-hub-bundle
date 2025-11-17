<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL;

final class AssetMetadataEvents
{
    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\AssetEvent")
     *
     * @var string
     */
    const PRE_RESOLVE = 'opendxp.datahub.graphql.asset.metadata.preResolve';
}
