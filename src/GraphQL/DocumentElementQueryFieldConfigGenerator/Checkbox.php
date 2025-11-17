<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\CheckboxType;

class Checkbox extends Base
{
    /**
     * @return CheckboxType
     */
    public function getFieldType()
    {
        return CheckboxType::getInstance();
    }
}
