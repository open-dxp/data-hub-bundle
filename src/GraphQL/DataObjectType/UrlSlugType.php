<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class UrlSlugType extends ObjectType
{
    use ServiceTrait;

    /** @var Data */
    protected $fieldDefinition;

    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, Data $fieldDefinition = null, $config = [], $context = [])
    {
        $this->fieldDefinition = $fieldDefinition;
        $this->setGraphQLService($graphQlService);
        $this->build($config);
        parent::__construct($config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $config['fields'] = self::getFieldConfig($this->getGraphQlService());
    }

    /**
     *
     * @return array[]
     */
    public static function getFieldConfig(Service $graphQlService)
    {
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\UrlSlug();
        $resolver->setGraphQLService($graphQlService);
        $fields = [
            'slug' => [
                'type' => Type::string(),
                'resolve' => [$resolver, 'resolveSlug'],
            ],
            'siteId' => [
                'type' => Type::int(),
                'resolve' => [$resolver, 'resolveSiteId'],
            ],
        ];

        return $fields;
    }
}
