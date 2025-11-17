<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\StringType;

class Slider extends Base
{
    /**
     * @return StringType
     */
    public function getFieldType()
    {
        return StringType::getInstance('csFeatureSlider', 'slidervalue');
    }
}
