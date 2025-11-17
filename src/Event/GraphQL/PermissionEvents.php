<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL;

final class PermissionEvents
{
    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\PermissionEvent")
     *
     * @var string
     */
    const PRE_CHECK = 'opendxp.datahub.graphql.permission.preCheck';
}
