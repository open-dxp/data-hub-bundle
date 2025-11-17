<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator\Helper;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\BaseDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Bundle\DataHubBundle\WorkspaceHelper;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;
use OpenDxp\Model\DataObject\Concrete;

class ReverseManyToManyObjects
{
    use ServiceTrait;

    /**
     * @var Data
     */
    public $fieldDefinition;

    /**
     * @var ClassDefinition
     */
    public $class;

    /**
     * @var string
     */
    public $attribute;

    /**
     * @param string $attribute
     * @param Data $fieldDefinition
     * @param ClassDefinition $class
     */
    public function __construct(Service $graphQlService, $attribute, $fieldDefinition, $class)
    {
        $this->fieldDefinition = $fieldDefinition;
        $this->class = $class;
        $this->attribute = $attribute;
        $this->setGraphQLService($graphQlService);
    }

    /**
     * @param BaseDescriptor|null $value
     * @param array $args
     * @param array $context
     *
     * @return array|null
     *
     * @throws \Exception
     */
    public function resolve($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        $objectId = $value['id'];
        $object = Concrete::getById($objectId);

        $relations = $object->getRelationData($this->fieldDefinition->getOwnerFieldName(), false, $this->fieldDefinition->getOwnerClassId());
        if ($relations) {
            $result = [];
            foreach ($relations as $relationRaw) {
                $relation = Concrete::getById($relationRaw['id']);
                if ($relation) {
                    if (!WorkspaceHelper::checkPermission($relation, 'read')) {
                        continue;
                    }

                    $data = new ElementDescriptor($relation);
                    $this->getGraphQlService()->extractData($data, $relation, $args, $context, $resolveInfo);
                    $result[] = $data;
                }
            }

            return $result;
        }

        return $relations;
    }
}
