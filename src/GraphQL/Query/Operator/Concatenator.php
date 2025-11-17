<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Model\Element\ElementInterface;

class Concatenator extends AbstractOperator
{
    private $glue;

    private $forceValue;

    /**
     * @param array|null $context
     */
    public function __construct(array $config, $context = null)
    {
        parent::__construct($config, $context);

        $this->glue = $config['glue'];
        $this->forceValue = $config['forceValue'] ?? false;
    }

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

        $hasValue = true;
        if (!$this->forceValue) {
            $hasValue = false;
        }

        $children = $this->getChildren();
        $valueArray = [];

        foreach ($children as $c) {
            $valueResolver = $this->getGraphQlService()->buildValueResolverFromAttributes($c);
            if (!$childResult = $valueResolver->getLabeledValue($element, $resolveInfo)) {
                continue;
            }

            $childValues = $childResult->value;
            if ($childValues && !is_array($childValues)) {
                $childValues = [$childValues];
            }

            if (is_array($childValues)) {
                foreach ($childValues as $value) {
                    if (!$hasValue) {
                        if (is_object($value) && method_exists($value, 'isEmpty')) {
                            $hasValue = !$value->isEmpty();
                        } else {
                            $hasValue = !empty($value);
                        }
                    }

                    if ($value !== null) {
                        $valueArray[] = $value;
                    }
                }
            }
        }

        if ($hasValue) {
            $result->value = implode($this->glue, $valueArray);

            return $result;
        }

        $result->empty = true;

        return $result;
    }
}
