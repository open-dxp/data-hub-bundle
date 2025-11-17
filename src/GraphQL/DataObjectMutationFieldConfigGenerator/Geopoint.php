<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

class Geopoint extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\Geopoint($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => $this->getGraphQlService()->getDataObjectTypeDefinition('geopoint_input'),
            'processor' => [$processor, 'process'],
        ];
    }
}
