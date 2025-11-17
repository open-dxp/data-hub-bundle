<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\MultiselectType;

class Multiselect extends Base
{
    /**
     * @return MultiselectType
     */
    public function getFieldType()
    {
        return MultiselectType::getInstance();
    }
}
