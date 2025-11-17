<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

class Image extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\Image($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => $this->getGraphQlService()->getDataObjectTypeDefinition('image_input'),
            'processor' => [$processor, 'process'],
            'description' => 'Asset ID',
        ];
    }
}
