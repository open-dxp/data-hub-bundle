<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL;

final class ListingEvents
{
    /**
     * @Event("OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model\ListingEvent")
     *
     * @var string
     */
    const PRE_LOAD = 'opendxp.datahub.graphql.listing.preLoad';
}
