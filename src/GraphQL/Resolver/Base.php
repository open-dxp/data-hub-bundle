<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\AbstractObject;
use OpenDxp\Model\DataObject\ClassDefinition;

class Base
{
    use ServiceTrait;

    /** @var string */
    protected $typeName;

    /** @var array */
    protected $attributes;

    /** @var ClassDefinition */
    protected $class;

    /** @var object */
    protected $container;

    /**
     * @param string $typeName
     * @param array $attributes
     * @param ClassDefinition $class
     * @param object $container
     */
    public function __construct($typeName, $attributes, $class, $container)
    {
        $this->typeName = $typeName;
        $this->attributes = $attributes;
        $this->class = $class;
        $this->container = $container;
    }

    /**
     * @param array $value
     * @param array $args
     * @param array $context
     *
     * @return \stdClass
     */
    public function resolve($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        /** @var \OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator\AbstractOperator $operatorImpl */
        $operatorImpl = $this->getGraphQlService()->buildQueryOperator($this->typeName, $this->attributes);

        $element = AbstractObject::getById($value['id']);
        $valueFromOperator = $operatorImpl->getLabeledValue($element, $resolveInfo);

        $value = $valueFromOperator->value ?? null;

        return $value;
    }

    /**
     * Helper method that allows dynamic inspection into the resolver attributes.
     *
     *
     */
    public function getResolverAttribute(string $type): ?string
    {
        if (isset($this->attributes['children'][0]) && !empty($this->attributes['children'][0])) {
            return $this->attributes['children'][0]['attributes'][$type];
        } else {
            return null;
        }
    }
}
