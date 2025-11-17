<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\EnumType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class LinkInputType extends InputObjectType
{
    use ServiceTrait;

    /**
     * @param array $config
     */
    public function __construct(Service $graphQlService, $config = ['name' => 'LinkInput'])
    {
        $this->setGraphQLService($graphQlService);
        $this->build($config);
        parent::__construct($config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\DataObject($this->getGraphQlService());
        $resolver->setGraphQLService($this->getGraphQlService());

        $config['fields'] = [
            'text' => Type::string(),
            'path' => Type::string(),
            'target' => new EnumType([
                'name' => 'target',
                'description' => 'Valid Link targets: "empty", "_blank", "_self", "_top", "_parent"',
                'values' => [
                    'empty' => ['value' => null],
                    '_blank',
                    '_self',
                    '_top',
                    '_parent',
                ],
            ]),
            'anchor' => Type::string(),
            'title' => Type::string(),
            'accesskey' => Type::string(),
            'rel' => Type::string(),
            'class' => Type::string(),
            'attributes' => Type::string(),
            'tabindex' => Type::string(),
            'parameters' => Type::string(),
        ];
    }
}
