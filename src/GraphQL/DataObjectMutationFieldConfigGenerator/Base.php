<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGeneratorInterface;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\ClassDefinition;

class Base implements DataObjectMutationFieldConfigGeneratorInterface
{
    use ServiceTrait;

    public function __construct(Service $graphQlService)
    {
        $this->setGraphQLService($graphQlService);
    }

    /**
     * @param array $nodeDef
     * @param ClassDefinition $class
     * @param mixed $container
     * @param array $params
     *
     * @return array
     */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\Base($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        return [
            'arg' => Type::string(),
            'processor' => [$processor, 'process'],
        ];
    }
}
