<?php


namespace OpenDxp\Bundle\DataHubBundle\Event;

final class ConfigurationEvents
{
    /**
     * Fired after a configuration was deleted
     *
     * Arguments:
     *  - configuration | the original configuration instance
     *
     * @Event("OpenDxp\Event\Model\GenericEvent")
     *
     * @var string
     */
    const CONFIGURATION_POST_DELETE = 'opendxp.datahub.configuration.postDelete';

    /**
     * Fired before a configuration gets saved
     *
     * Arguments:
     *  - configuration | the original configuration instance
     *
     * @Event("OpenDxp\Event\Model\GenericEvent")
     *
     * @var string
     */
    const CONFIGURATION_PRE_SAVE = 'opendxp.datahub.configuration.preSave';

    /**
     * Fired after a configuration was saved
     *
     * Arguments:
     *  - configuration | the original configuration instance
     *
     * @Event("OpenDxp\Event\Model\GenericEvent")
     *
     * @var string
     */
    const CONFIGURATION_POST_SAVE = 'opendxp.datahub.configuration.postSave';
}
