<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentResolver;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\RelationHelper;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\Document;

class Email
{
    use ServiceTrait;

    /**
     * @param array|null $value
     * @param array $args
     * @param array $context
     *
     * @return ElementDescriptor|null
     *
     * @throws \Exception
     */
    public function resolveObject($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        $documentId = $value['id'];
        $document = Document::getById($documentId);

        if ($document instanceof Document\Link) {
            $relation = $document->getElement();
            if ($relation) {
                return RelationHelper::processRelation($relation, $this->getGraphQlService(), $args, $context, $resolveInfo);
            }
        }

        return null;
    }
}
