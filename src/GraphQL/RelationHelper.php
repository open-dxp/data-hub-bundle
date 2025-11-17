<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Model\Element\ElementInterface;

class RelationHelper
{
    /**
     * @param array $args
     * @param array $context
     *
     * @return ElementDescriptor
     */
    public static function processRelation(ElementInterface $relation, Service $graphQlService, $args, $context, ResolveInfo $resolveInfo)
    {
        $data = new ElementDescriptor($relation);
        $graphQlService->extractData($data, $relation, $args, $context, $resolveInfo);

        return $data;
    }
}
