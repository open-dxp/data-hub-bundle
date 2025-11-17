<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\ImageType;

class Image extends Base
{
    /**
     * @return ImageType
     */
    public function getFieldType()
    {
        return ImageType::getInstance($this->getGraphQlService());
    }
}
