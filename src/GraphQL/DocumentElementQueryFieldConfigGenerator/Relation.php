<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\RelationType;

class Relation extends Base
{
    /**
     * @return RelationType
     *
     * @throws \Exception
     */
    public function getFieldType()
    {
        return RelationType::getInstance($this->getGraphQlService());
    }
}
