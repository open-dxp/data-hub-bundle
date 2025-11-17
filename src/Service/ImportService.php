<?php


namespace OpenDxp\Bundle\DataHubBundle\Service;

use OpenDxp\Bundle\DataHubBundle\Configuration;
use OpenDxp\Extension\Bundle\OpenDxpBundleManager;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ImportService
{
    public function __construct(
        protected OpenDxpBundleManager $bundleManager,
        protected ContainerBagInterface $parameterBag
    ) {
    }

    public function importConfigurationJson(string $json): Configuration
    {
        $importData = json_decode($json, true);
        $this->checkValidity($importData);

        $configuration = new Configuration(
            $importData['type'],
            $importData['path'],
            $importData['name']
        );
        $configuration->setModificationDate(time());
        $configuration->setConfiguration($importData['configuration']);
        $configuration->save();

        return $configuration;
    }

    /**
     * @throws \Exception
     */
    protected function checkValidity(array $configuration): void
    {
        if (!array_key_exists('type', $configuration) ||
            !array_key_exists('path', $configuration) ||
            !array_key_exists('name', $configuration)) {
            throw new \Exception('Required configuration keys ("type", "path" or "name") not found!');
        }

        if (!$this->isBundleInstalled($configuration['type'])) {
            throw new \Exception(sprintf(
                'Cant handle type "%s". Seems that the according bundle is not installed!',
                $configuration['type']
            ));
        }

        $configuration = Configuration::getByName($configuration['name']);
        if ($configuration instanceof Configuration) {
            throw new \Exception('Name already exists.');
        }
    }

    protected function isBundleInstalled(?string $type): bool
    {
        $registeredBundles = $this->parameterBag->get('opendxp_data_hub');

        return array_key_exists($type, $registeredBundles['supported_types']);
    }
}
