<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\WysiwygType;

class Wysiwyg extends Base
{
    /**
     * @return WysiwygType
     */
    public function getFieldType()
    {
        return WysiwygType::getInstance();
    }
}
