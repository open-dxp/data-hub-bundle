<?php


namespace OpenDxp\Bundle\DataHubBundle\Event;

final class AdminEvents
{
    /**
     * Allows you to modify/append the the configuration list.
     *
     * Arguments:
     *  - list | the configuration list
     *
     * @Event("OpenDxp\Event\Model\GenericEvent")
     *
     * @var string
     */
    const CONFIGURATION_LIST = 'opendxp.datahub.admin.configuration.list';
}
