<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationOperatorConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\LocaleCollectorOperator;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\LocalizedType;

class LocaleCollector extends Base
{
    /**
     * @param array $nodeDef
     * @param \OpenDxp\Model\DataObject\ClassDefinition|null $class
     * @param object|null $container
     * @param array $params
     *
     * @return array
     */
    public function getGraphQlMutationOperatorConfig($nodeDef, $class = null, $container = null, $params = [])
    {
        $processor = new LocaleCollectorOperator($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        $factories = $this->getGraphQlService()->getDataObjectMutationTypeGeneratorFactories();

        $typeName = strtolower($nodeDef['attributes']['class']);
        $factory = $factories->get('typegenerator_dataobjectmutationoperator_' . $typeName);
        $determinedType = LocalizedType::getInstance(
            $factory->resolveInputTypeFromNodeDef($nodeDef, $class, $container)
        );

        return [
            'arg' => $determinedType,
            'processor' => [$processor, 'process'],
        ];
    }
}
