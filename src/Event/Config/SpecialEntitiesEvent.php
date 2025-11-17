<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\Config;

use OpenDxp\Bundle\DataHubBundle\Model\SpecialEntitySetting;
use Symfony\Contracts\EventDispatcher\Event;

class SpecialEntitiesEvent extends Event
{
    protected $specialSettings;

    protected $config;

    public function __construct(array $specialSettings, array $config)
    {
        $this->specialSettings = $specialSettings;
        $this->config = $config;
    }

    /**
     * @return SpecialEntitySetting[]
     */
    public function getSpecialSettings(): array
    {
        return $this->specialSettings;
    }

    public function addSpecialSetting(SpecialEntitySetting $setting)
    {
        $this->specialSettings[] = $setting;
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}
