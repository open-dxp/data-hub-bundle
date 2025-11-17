<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\ScheduledblockDataType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\ScheduledblockType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class Scheduledblock extends Base
{
    /** @var ScheduledblockDataType */
    protected $scheduledblockDataType;

    public function __construct(Service $graphQlService, ScheduledblockDataType $scheduledblockDataType)
    {
        $this->scheduledblockDataType = $scheduledblockDataType;
        parent::__construct($graphQlService);
    }

    /**
     * @return ScheduledblockType
     */
    public function getFieldType()
    {
        return \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\ScheduledblockType::getInstance($this->scheduledblockDataType);
    }
}
