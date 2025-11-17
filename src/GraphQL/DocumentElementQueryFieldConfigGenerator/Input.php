<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\InputType;

class Input extends Base
{
    /**
     * @return InputType
     */
    public function getFieldType()
    {
        return InputType::getInstance();
    }
}
