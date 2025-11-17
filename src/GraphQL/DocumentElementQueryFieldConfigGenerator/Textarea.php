<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\TextareaType;

class Textarea extends Base
{
    /**
     * @return TextareaType
     */
    public function getFieldType()
    {
        return TextareaType::getInstance();
    }
}
