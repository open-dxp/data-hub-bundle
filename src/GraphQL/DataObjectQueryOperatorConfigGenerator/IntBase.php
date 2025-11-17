<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryOperatorConfigGenerator;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Model\DataObject\ClassDefinition;

class IntBase extends Base
{
    /**
     * @param string $typeName
     * @param array $nodeDef
     * @param ClassDefinition|null $class
     * @param object|null $container
     * @param array $params

     *
     * @return ScalarType|Type
     */
    public function getGraphQlType($typeName, $nodeDef, $class = null, $container = null, $params = [])
    {
        return Type::int();
    }

    /**
     * @param array $attributes
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return \GraphQL\Type\Definition\ScalarType
     */
    public function getFieldType($attributes, $class = null, $container = null)
    {
        return Type::int();
    }
}
