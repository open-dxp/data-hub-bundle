<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Value;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\Element\ElementInterface;

class DefaultValue extends AbstractValue
{
    /**
     * @param ElementInterface|null $element
     *
     * @return \stdClass|null
     */
    public function getLabeledValue($element, ResolveInfo $resolveInfo = null)
    {
        if ($element instanceof Concrete) {
            $result = new \stdClass();

            if ($this->dataType == 'system') {
                $getter = 'get' . ucfirst($this->attribute);
                $result->value = $element->$getter();

                return $result;
            }

            $class = $element->getClass();
            $fieldHelper = $this->getGraphQlService()->getObjectFieldHelper();
            $fieldDefinition = $fieldHelper->getFieldDefinitionFromKey($class, $this->attribute);

            $valueParams = new ElementDescriptor($element);

            $resolveFn = $this->getGraphQlService()->buildDataObjectDataQueryResolver($this->attribute, $fieldDefinition, $class);
            $args = [];

            $value = $resolveFn($valueParams, $args, $this->context, $resolveInfo);
            if (!$value) {
                return null;
            }

            $result->value = $this->getGraphQlService()->getElementFromArrayObject($value);

            return $result;
        }

        return null;
    }
}
