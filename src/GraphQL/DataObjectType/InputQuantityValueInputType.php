<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class InputQuantityValueInputType extends InputObjectType
{
    use ServiceTrait;

    /**
     * @param array $config
     */
    public function __construct(Service $graphQlService, $config = ['name' => 'InputQuantityValueInput'])
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
            'value' => Type::string(),
            'unit' => Type::string(),
            'unitId' => Type::string(),
        ];
    }
}
