<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\AreablockDataType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\AreablockType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class Areablock extends Base
{
    protected $areablockDataType;

    public function __construct(Service $graphQlService, AreablockDataType $areablockDataType)
    {
        $this->areablockDataType = $areablockDataType;
        parent::__construct($graphQlService);
    }

    /**
     * @return AreablockType
     */
    public function getFieldType()
    {
        return \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\AreablockType::getInstance($this->areablockDataType);
    }
}
