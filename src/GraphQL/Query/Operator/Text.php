<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Model\Element\ElementInterface;

class Text extends AbstractOperator
{
    /**
     * @param array|null $context
     */
    public function __construct(array $config, $context = null)
    {
        parent::__construct($config, $context);
    }

    /**
     * @param ElementInterface|null $element
     *
     * @return \stdClass
     */
    public function getLabeledValue($element, ResolveInfo $resolveInfo = null)
    {
        $result = new \stdClass();
        $result->label = $this->label;
        $result->value = $result->label;

        return $result;
    }
}
