<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\UnionType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\AssetType\AssetType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class VideoTypeDataType extends UnionType
{
    use ServiceTrait;

    /** @var AssetType */
    protected $assetType;

    public function __construct(Service $graphQlService)
    {
        $this->setGraphQLService($graphQlService);

        // @phpstan-ignore-next-line - We can't define the types in the constructor because the `getTypes` method is overwritten
        parent::__construct(['name' => 'VideoData']);
    }

    /**
     *
     * @throws \Exception
     */
    public function getTypes(): array
    {
        // why not just use scalars ?
        // https://kamranicus.com/posts/2018-07-02-handling-multiple-scalar-types-in-graphql
        $service = $this->getGraphQlService();
        $this->assetType = $service->buildAssetType('asset');

        return [
            new ObjectType([
                    'name' => 'VideoDataDescriptor',
                    'fields' => [
                        'id' => ['type' => Type::string(), 'description' => 'external ID'],
                    ],
                ]
            ),
            $this->assetType,
        ];
    }

    public function resolveType($element, $context, ResolveInfo $info)
    {
        if ($element instanceof ElementDescriptor) {
            return $this->assetType;
        }

        return $info->schema->getType('VideoDataDescriptor');
    }
}
