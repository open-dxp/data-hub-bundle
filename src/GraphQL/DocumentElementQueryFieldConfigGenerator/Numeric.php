<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\NumericType;

class Numeric extends Base
{
    /**
     * @return NumericType
     */
    public function getFieldType()
    {
        return NumericType::getInstance();
    }
}
