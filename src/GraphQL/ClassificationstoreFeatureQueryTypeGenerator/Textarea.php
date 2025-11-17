<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\StringType;

class Textarea extends Base
{
    /**
     * @return StringType
     */
    public function getFieldType()
    {
        return StringType::getInstance('csFeatureTextarea', 'text');
    }
}
