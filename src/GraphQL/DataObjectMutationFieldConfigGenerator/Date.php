<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

use GraphQL\Type\Definition\Type;

class Date extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\Date($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => Type::string(),
            'processor' => [$processor, 'process'],
            'description' => 'Either as unix timestamp (as string) or date string',
        ];
    }
}
