<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL;

use OpenDxp\Bundle\DataHubBundle\Configuration;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\OpenDxpObjectType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Exception\ClientSafeException;
use OpenDxp\Bundle\DataHubBundle\OpenDxpDataHubBundle;
use OpenDxp\Cache\RuntimeCache;
use OpenDxp\Db;
use OpenDxp\Model\DataObject\ClassDefinition;

class ClassTypeDefinitions
{
    /**
     * @var array
     */
    public static $definitions = [];

    /**
     * @param array $context
     */
    public static function build(Service $graphQlService, $context = [])
    {
        $db = Db::get();
        $listing = $db->fetchAllAssociative('SELECT id, name FROM classes');
        foreach ($listing as $class) {
            self::$definitions[$class['name']] = $graphQlService->buildDataObjectType($class['name'], [], $context);
        }

        /**
         * @var OpenDxpObjectType $definition
         */
        foreach (self::$definitions as $definition) {
            $definition->build($context);
        }
    }

    /**
     * @param string|ClassDefinition $class
     *
     * @return OpenDxpObjectType
     *
     * @throws \Exception
     */
    public static function get($class)
    {
        $className = is_string($class) ? $class : $class->getName();
        $result = self::$definitions[$className];
        if (!$result) {
            throw new ClientSafeException('type definition ' . $className . ' not found');
        }

        return $result;
    }

    /**
     * @param bool $onlyQueryTypes
     *
     * @return array
     *
     * @throws \Exception
     */
    public static function getAll($onlyQueryTypes = false)
    {
        if ($onlyQueryTypes) {
            $context = RuntimeCache::get(OpenDxpDataHubBundle::RUNTIME_CONTEXT_KEY);
            /** @var Configuration $configuration */
            $configuration = $context['configuration'];
            $types = array_keys($configuration->getConfiguration()['schema']['queryEntities']);
            $result = [];
            foreach ($types as $type) {
                if (isset(self::$definitions[$type])) {
                    $result[] = self::$definitions[$type];
                }
            }

            return $result;
        }

        return self::$definitions;
    }
}
