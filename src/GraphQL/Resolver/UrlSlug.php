<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class UrlSlug
{
    use ServiceTrait;

    /**
     * @param \OpenDxp\Model\DataObject\Data\UrlSlug|null $value
     * @param array $args
     * @param array $context
     *
     * @return string|null
     *
     * @throws \Exception
     */
    public function resolveSlug($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        if ($value instanceof \OpenDxp\Model\DataObject\Data\UrlSlug) {
            return $value->getSlug();
        }

        return null;
    }

    /**
     * @param \OpenDxp\Model\DataObject\Data\UrlSlug|null $value
     * @param array $args
     * @param array $context
     *
     * @return int|null
     *
     * @throws \Exception
     */
    public function resolveSiteId($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        if ($value instanceof \OpenDxp\Model\DataObject\Data\UrlSlug) {
            return $value->getSiteId();
        }

        return null;
    }
}
