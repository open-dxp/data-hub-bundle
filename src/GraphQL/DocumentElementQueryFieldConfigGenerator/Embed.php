<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\EmbedType;

class Embed extends Base
{
    /**
     * @return EmbedType
     */
    public function getFieldType()
    {
        return EmbedType::getInstance();
    }
}
