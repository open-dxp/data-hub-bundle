<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\BooleanSelectType;

class BooleanSelect extends Base
{
    /**
     * @return BooleanSelectType
     */
    public function getFieldType()
    {
        return BooleanSelectType::getInstance();
    }
}
