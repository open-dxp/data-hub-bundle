<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\AssetType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class AssetEmbeddedMetaInfoItem extends ObjectType
{
    use ServiceTrait;

    /**
     * @param array $config
     */
    public function __construct(Service $graphQlService, $config = [])
    {
        $this->graphQlService = $graphQlService;
        $config['name'] = 'asset_embeddedMetaInfo_item';
        $this->build($config);
        parent::__construct($config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $config['fields'] = [
            'name' => Type::string(),
            'value' => Type::string(),
        ];
    }
}
