<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\DateType;

class Date extends Base
{
    /**
     * @return DateType
     */
    public function getFieldType()
    {
        return DateType::getInstance();
    }
}
