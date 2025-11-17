<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\QuantityValueType;

class QuantityValue extends Base
{
    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function getFieldType()
    {
        return QuantityValueType::getInstance($this->getGraphQlService(), 'csFeatureQuantityValue', 'quantity_value', 'quantityvalue');
    }
}
