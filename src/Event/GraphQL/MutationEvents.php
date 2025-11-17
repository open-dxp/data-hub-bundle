<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL;

final class MutationEvents
{
    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\MutationTypeEvent")
     *
     * @var string
     */
    const PRE_BUILD = 'opendxp.datahub.graphql.mutation.preBuild';

    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\MutationTypeEvent")
     *
     * @var string
     */
    const POST_BUILD = 'opendxp.datahub.graphql.mutation.postBuild';
}
