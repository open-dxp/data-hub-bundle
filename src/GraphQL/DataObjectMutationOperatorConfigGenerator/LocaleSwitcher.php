<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationOperatorConfigGenerator;

use OpenDxp\Model\DataObject\ClassDefinition;

class LocaleSwitcher extends Base
{
    /**
     * @param array $nodeDef
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return array
     */
    public function getGraphQlMutationOperatorConfig($nodeDef, $class = null, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\LocaleSwitcherOperator($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        $factories = $this->getGraphQlService()->getDataObjectMutationTypeGeneratorFactories();

        $typeName = strtolower($nodeDef['attributes']['class']);
        $factory = $factories->get('typegenerator_dataobjectmutationoperator_' . $typeName);
        $determinedType = $factory->resolveInputTypeFromNodeDef($nodeDef, $class, $container);

        return [
            'arg' => $determinedType,
            'processor' => [$processor, 'process'],
        ];
    }
}
