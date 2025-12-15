<?php
declare(strict_types=1);

/**
 * OpenDXP
 *
 * This source file is licensed under the GNU General Public License version 3 (GPLv3).
 *
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (https://pimcore.com)
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator\Helper;

use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\BaseDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Bundle\DataHubBundle\WorkspaceHelper;
use OpenDxp\Model\Asset;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\Fieldcollection;

/**
 * Class Hotspotimage
 *
 * @package OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator\Helper
 */
class Hotspotimage
{
    use ServiceTrait;

    /**
     * @var ClassDefinition\Data\Hotspotimage
     */
    public $fieldDefinition;

    /**
     * @var ClassDefinition|Fieldcollection\Definition
     */
    public $class;

    /**
     * @var string
     */
    public $attribute;

    /**
     * @param string $attribute
     * @param ClassDefinition|Fieldcollection\Definition $class
     */
    public function __construct(
        Service $graphQlService,
        $attribute,
        ClassDefinition\Data\Hotspotimage $fieldDefinition,
        $class
    ) {
        $this->fieldDefinition = $fieldDefinition;
        $this->class = $class;
        $this->attribute = $attribute;
        $this->setGraphQLService($graphQlService);
    }

    /**
     * @param BaseDescriptor|null $value
     * @param array $args
     * @param array $context
     *
     * @return ElementDescriptor|null
     *
     * @throws Exception
     */
    public function resolve($value = null, $args = [], $context = [], ?ResolveInfo $resolveInfo = null)
    {
        $container = Service::resolveValue($value, $this->fieldDefinition, $this->attribute, $args);
        if ($container instanceof \OpenDxp\Model\DataObject\Data\Hotspotimage) {
            $image = $container->getImage();
            if ($image instanceof Asset) {
                if (WorkspaceHelper::checkPermission($image, 'read')) {
                    $data = new ElementDescriptor($image);
                    $this->getGraphQlService()->extractData($data, $image, $args, $context, $resolveInfo);

                    $data['crop'] = $container->getCrop();
                    $data['hotspots'] = $container->getHotspots();
                    $data['marker'] = $container->getMarker();

                    return $data;
                }
            }
        }

        return null;
    }
}
