<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class LocaleSwitcherOperator extends BaseOperator
{
    protected $locale;

    /**
     * @param array $nodeDef
     */
    public function __construct($nodeDef)
    {
        parent::__construct($nodeDef);
        $this->locale = $nodeDef['attributes']['locale'];
    }

    /**
     * @param Concrete|AbstractData $object
     * @param array $newValue
     * @param array $args
     * @param array $context
     */
    public function process($object, $newValue, $args, $context, ResolveInfo $info)
    {
        $localeService = $this->getGraphQlService()->getLocaleService();

        $currentLocale = $localeService->getLocale();

        $localeService->setLocale($this->locale);

        $class = $object->getClass();
        $parentProcessor = $this->getParentProcessor($this->nodeDef, $class);
        if ($parentProcessor) {
            call_user_func_array($parentProcessor, [$object, $newValue, $args, $context, $info]);
        }

        $localeService->setLocale($currentLocale);
    }
}
