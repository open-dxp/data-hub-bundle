<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryOperatorConfigGenerator;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\MergeType;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\Localizedfield;

/**
 * @deprecated will be removed in Data Hub 2
 */
class Merge extends StringBase
{
    /**
     * @param string $typeName
     * @param array $nodeConfig
     * @param ClassDefinition|null $class
     * @param object|null $container
     * @param array $params
     *
     * @return array
     */
    public function getGraphQlQueryOperatorConfig($typeName, $nodeConfig, $class = null, $container = null, $params = [])
    {
        $attributes = $nodeConfig['attributes'];
        $fieldname = $this->getFieldname($attributes);

        $type = $this->getGraphQlType($typeName, $nodeConfig, $class, $container, $params);
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\Merge($typeName, $attributes, $class, $container);
        $resolver->setGraphQlService($this->graphQlService);

        return $this->enrichConfig(
            [
                'name' => $fieldname,
                'type' => $type,
                'resolve' => [$resolver, 'resolve'],
            ],
            $container
        );
    }

    /**
     * @param array $config
     * @param object|null $container
     *
     * @return array
     */
    public function enrichConfig($config, $container = null)
    {
        if ($container instanceof Localizedfield) {
            $config['args'] = $config['args'] ? $config['args'] : [];
            $config['args'] = array_merge(
                $config['args'],
                ['language' => ['type' => Type::string()],
                ]
            );
        }

        return $config;
    }

    /**
     * @param string $typeName
     * @param array $nodeDef
     * @param ClassDefinition|null $class
     * @param object|null $container
     * @param array $params
     *
     * @return ListOfType|Type
     */
    public function getGraphQlType($typeName, $nodeDef, $class = null, $container = null, $params = [])
    {
        $attributes = $nodeDef['attributes'];
        $fieldname = $this->getFieldname($attributes);
        $typename = 'operator_'.$fieldname;

        $mergeType = new MergeType($this->graphQlService, $nodeDef, $class, $container, ['name' => $typename]);

        $result = ListOfType::listOf($mergeType);

        return $result;
    }
}
