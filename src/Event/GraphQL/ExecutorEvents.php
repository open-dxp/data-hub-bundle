<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL;

final class ExecutorEvents
{
    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\ExecutorEvent")
     *
     * @var string
     */
    const PRE_EXECUTE = 'opendxp.datahub.graphql.executor.preExecute';

    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\ExecutorResultEvent")
     *
     * @var string
     */
    const POST_EXECUTE = 'opendxp.datahub.graphql.executor.postExecute';
}
