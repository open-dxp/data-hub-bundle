<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

use GraphQL\Type\Definition\Type;

class ExternalImage extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\ExternalImage($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => Type::string(),
            'processor' => [$processor, 'process'],
            'description' => 'External Image URL',
        ];
    }
}
