<?php


namespace OpenDxp\Bundle\DataHubBundle\EventListener;

use OpenDxp\Bundle\AdminBundle\Event\IndexActionSettingsEvent;

class AdminListener
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Handles INDEX_ACTION_SETTINGS event and adds custom admin UI settings
     *
     */
    public function addIndexSettings(IndexActionSettingsEvent $event)
    {
        $event->addSetting('data-hub-writeable', (new \OpenDxp\Bundle\DataHubBundle\Configuration(null, null))->isWriteable());
        $this->addEventSetting('allow_introspection', $event);
        $this->addEventSetting('allow_sqlObjectCondition', $event);
    }

    private function addEventSetting(
        string $key,
        IndexActionSettingsEvent $event
    ): void {
        $value = $this->config['graphql'][$key] ?? true;
        $event->addSetting($key, $value);
    }
}
