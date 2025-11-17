<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use OpenDxp\Model\DataObject\ClassDefinition\Data;

class InputQuantityValue extends Base
{
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        return $this->getGraphQlService()->getDataObjectTypeDefinition('input_quantity_value');
    }
}
