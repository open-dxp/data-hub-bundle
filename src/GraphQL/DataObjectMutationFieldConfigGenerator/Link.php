<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

class Link extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\Link($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => $this->getGraphQlService()->getDataObjectTypeDefinition('link_input'),
            'processor' => [$processor, 'process'],
        ];
    }
}
