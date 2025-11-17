<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

use GraphQL\Type\Definition\Type;

class Multiselect extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\Base($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => Type::listOf(Type::string()),
            'processor' => [$processor, 'process'],
        ];
    }
}
