<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\DateType;

class Date extends Base
{
    /**
     * @return DateType|null
     */
    public function getFieldType()
    {
        return DateType::getInstance();
    }
}
