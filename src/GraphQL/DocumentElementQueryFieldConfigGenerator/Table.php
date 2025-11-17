<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\TableType;

class Table extends Base
{
    /**
     * @return TableType
     */
    public function getFieldType()
    {
        return TableType::getInstance();
    }
}
