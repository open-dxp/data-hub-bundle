<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\BlockType;

class Block extends Base
{
    /**
     * @return BlockType
     */
    public function getFieldType()
    {
        return BlockType::getInstance();
    }
}
