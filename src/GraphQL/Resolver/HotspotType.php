<?php
declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Bundle\DataHubBundle\WorkspaceHelper;
use OpenDxp\Model\Asset;
use OpenDxp\Model\Element\Data\MarkerHotspotItem;

/**
 * Class HotspotType
 *
 * @package OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver
 */
class HotspotType
{
    use ServiceTrait;

    /**
     * @param ElementDescriptor|null $value
     * @param array $args
     * @param array $context
     *
     * @return ElementDescriptor|null
     *
     * @throws \Exception
     */
    public function resolveImage($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        if ($value instanceof ElementDescriptor) {
            $image = Asset::getById($value['id']);
            if (!WorkspaceHelper::checkPermission($image, 'read')) {
                return null;
            }

            $data = new ElementDescriptor($image);
            $this->getGraphQlService()->extractData($data, $image, $args, $context, $resolveInfo);
            $data['data'] = isset($data['data']) ? base64_encode($data['data']) : null;

            return $data;
        }

        return null;
    }

    /**
     * @param ElementDescriptor|null $value
     * @param array $args
     * @param array $context
     *
     * @return array
     *
     * @throws \Exception
     */
    public function resolveCrop($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        return !empty($value['crop']) ? $value['crop'] : null;
    }

    /**
     * @param ElementDescriptor|null $value
     * @param array $args
     * @param array $context
     *
     * @return array
     *
     * @throws \Exception
     */
    public function resolveHotspots($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        return !empty($value['hotspots']) ? $value['hotspots'] : null;
    }

    /**
     * @param ElementDescriptor|null $value
     * @param array $args
     * @param array $context
     *
     * @return array
     *
     * @throws \Exception
     */
    public function resolveMarker($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        return !empty($value['marker']) ? $value['marker'] : null;
    }

    /**
     * @param array $value
     * @param array $args
     * @param array $context
     */
    public function resolveMetadata($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        /** @var array $metadata */
        $metadata = is_array($value) ? $value['data'] : [];
        if (isset($args['keys'])) {
            /** @var MarkerHotspotItem $item */
            foreach ($metadata as $idx => $item) {
                $name = $item->getName();
                if (!in_array($name, $args['keys'])) {
                    unset($metadata[$idx]);
                }
            }
        }

        return $metadata;
    }
}
