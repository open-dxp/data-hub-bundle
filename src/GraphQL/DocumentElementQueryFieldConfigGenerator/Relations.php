<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\RelationsType;

class Relations extends Base
{
    /**
     * @return RelationsType
     *
     * @throws \Exception
     */
    public function getFieldType()
    {
        return RelationsType::getInstance($this->getGraphQlService());
    }
}
