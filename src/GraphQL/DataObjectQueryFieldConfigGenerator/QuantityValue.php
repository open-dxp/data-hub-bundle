<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use OpenDxp\Model\DataObject\ClassDefinition\Data;

class QuantityValue extends Base
{
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        return $this->getGraphQlService()->getDataObjectTypeDefinition('quantity_value');
    }
}
