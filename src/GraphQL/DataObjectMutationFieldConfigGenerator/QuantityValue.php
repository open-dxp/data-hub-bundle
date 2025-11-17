<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

class QuantityValue extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\QuantityValue($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => $this->getGraphQlService()->getDataObjectTypeDefinition('quantity_value_input'),
            'processor' => [$processor, 'process'],
        ];
    }
}
