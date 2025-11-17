<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\SelectType;

class Select extends Base
{
    /**
     * @return SelectType
     */
    public function getFieldType()
    {
        return SelectType::getInstance();
    }
}
