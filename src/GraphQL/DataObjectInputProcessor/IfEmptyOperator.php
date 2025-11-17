<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Exception\ClientSafeException;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class IfEmptyOperator extends BaseOperator
{
    /**
     * @param array $nodeDef
     */
    public function __construct($nodeDef)
    {
        parent::__construct($nodeDef);
    }

    /**
     * @param Concrete|AbstractData $object
     * @param array $newValue
     * @param array $args
     * @param array $context
     *
     * @return void|null
     *
     * @throws \Exception|\UnexpectedValueException
     */
    public function process($object, $newValue, $args, $context, ResolveInfo $info)
    {
        $class = $object->getClass();

        $nodeDef = $this->nodeDef;
        $nodeDefAttributes = $nodeDef['attributes'];
        $children = $nodeDefAttributes['children'];
        if (!$children) {
            return null;
        }

        if (count($children) !== 1) {
            throw new ClientSafeException('Only one child allowed');
        }

        $firstChild = $children[0];

        if ($firstChild['isOperator']) {
            throw new ClientSafeException('First child should not be an operator');
        }

        $key = $firstChild['attributes']['attribute'];
        $fieldDefinition = $this->getGraphQlService()->getObjectFieldHelper()->getFieldDefinitionFromKey($class, $key);
        if ($fieldDefinition) {
            $valueResolver = $this->getGraphQlService()->buildValueResolverFromAttributes($firstChild);
            $valueFromChild = $valueResolver->getLabeledValue($object, null);

            if (!$valueFromChild || $fieldDefinition->isEmpty($valueFromChild->value)) {
                $parentProcessor = $this->getParentProcessor($this->nodeDef, $class);
                if ($parentProcessor) {
                    call_user_func_array($parentProcessor, [$object, $newValue, $args, $context, $info]);
                }
            }
        }
    }
}
