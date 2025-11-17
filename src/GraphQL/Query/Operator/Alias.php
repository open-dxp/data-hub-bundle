<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Model\Element\ElementInterface;

class Alias extends AbstractOperator
{
    /**
     * @param ElementInterface|null $element
     *
     * @return \stdClass
     *
     * @throws \Exception
     */
    public function getLabeledValue($element, ResolveInfo $resolveInfo = null)
    {
        $result = new \stdClass();
        $result->label = $this->label;

        $children = $this->getChildren();

        if (!$children) {
            return $result;
        }

        $c = $children[0];

        $valueResolver = $this->getGraphQlService()->buildValueResolverFromAttributes($c);

        $valueFromChild = $valueResolver->getLabeledValue($element, $resolveInfo);
        if ($valueFromChild) {
            $result->value = $valueFromChild->value;
        }

        return $result;
    }
}
