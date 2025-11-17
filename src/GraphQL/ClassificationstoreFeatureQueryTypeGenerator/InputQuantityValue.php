<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\QuantityValueType;

class InputQuantityValue extends Base
{
    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function getFieldType()
    {
        return QuantityValueType::getInstance($this->getGraphQlService(), 'csFeatureInputQuantityValue', 'input_quantity_value', 'inputquantityvalue');
    }
}
