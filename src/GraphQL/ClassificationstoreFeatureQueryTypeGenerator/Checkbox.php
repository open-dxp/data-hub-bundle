<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\CheckboxType;

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
