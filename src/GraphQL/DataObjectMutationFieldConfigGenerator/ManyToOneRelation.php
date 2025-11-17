<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

class ManyToOneRelation extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\ManyToOneRelation($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => $this->getGraphQlService()->getDataObjectTypeDefinition('elementdescriptor_input'),
            'processor' => [$processor, 'process'],
        ];
    }
}
