<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\LinkDataType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class Link extends Base
{
    protected $linkDataType;

    public function __construct(Service $graphQlService, LinkDataType $linkDataType)
    {
        $this->linkDataType = $linkDataType;
        parent::__construct($graphQlService);
    }

    /**
     * @return \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\LinkType
     */
    public function getFieldType()
    {
        return \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\LinkType::getInstance($this->linkDataType);
    }
}
