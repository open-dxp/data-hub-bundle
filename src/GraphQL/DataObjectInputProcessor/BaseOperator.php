<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class BaseOperator extends Base
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
     */
    public function process($object, $newValue, $args, $context, ResolveInfo $info)
    {
        $class = $object->getClass();
        $parentProcessor = $this->getParentProcessor($this->nodeDef, $class);
        if ($parentProcessor) {
            // nothing to do with the value1
            call_user_func_array($parentProcessor, [$object, $newValue, $args, $context, $info]);
        }
    }
}
