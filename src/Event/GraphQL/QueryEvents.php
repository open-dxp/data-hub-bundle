<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL;

final class QueryEvents
{
    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\QueryTypeEvent")
     *
     * @var string
     */
    const PRE_BUILD = 'opendxp.datahub.graphql.query.preBuild';

    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\QueryTypeEvent")
     *
     * @var string
     */
    const POST_BUILD = 'opendxp.datahub.graphql.query.postBuild';
}
