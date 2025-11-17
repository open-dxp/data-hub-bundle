<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\VideoType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class Video extends Base
{
    /**
     *
     * @throws \Exception
     */
    public function __construct(Service $graphQlService)
    {

        //        $this->assetType = $assetType;
        parent::__construct($graphQlService);
    }

    /**
     * @return VideoType
     */
    public function getFieldType()
    {
        $service = $this->getGraphQlService();
        $assetType = $service->buildAssetType('asset');

        return \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\VideoType::getInstance($this->getGraphQlService(), $assetType);
    }
}
