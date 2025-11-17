<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\AbstractObject;
use OpenDxp\Model\DataObject\ClassDefinition;

/**
 * @deprecated will be removed in Data Hub 2
 */
class Merge
{
    use ServiceTrait;

    /** @var string|null */
    protected $typeName;

    /** @var array|null */
    protected $attributes;

    /** @var ClassDefinition|null */
    protected $class;

    /** @var object|null */
    protected $container;

    /**
     * @param string|null $typeName
     * @param array|null $attributes
     * @param ClassDefinition|null $class
     * @param object|null $container
     */
    public function __construct($typeName = null, $attributes = null, $class = null, $container = null)
    {
        $this->typeName = $typeName;
        $this->attributes = $attributes;
        $this->class = $class;
        $this->container = $container;
    }

    /**
     * @param mixed $value
     * @param array $args
     * @param array $context
     *
     * @return array|null
     *
     * @throws \Exception
     */
    public function resolve($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        /** @var \OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator\AbstractOperator $operatorImpl */
        $operatorImpl = $this->getGraphQlService()->buildQueryOperator($this->typeName, $this->attributes);

        $element = AbstractObject::getById($value['id']);
        $valueFromOperator = $operatorImpl->getLabeledValue($element, $resolveInfo);

        return $valueFromOperator?->value;
    }
}
