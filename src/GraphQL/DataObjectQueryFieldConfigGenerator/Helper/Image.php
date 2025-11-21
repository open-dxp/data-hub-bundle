<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator\Helper;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\BaseDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Bundle\DataHubBundle\WorkspaceHelper;
use OpenDxp\Model\Asset;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class Image
{
    use ServiceTrait;

    /**
     * @var Data
     */
    public $fieldDefinition;

    /**
     * @var ClassDefinition
     */
    public $class;

    /**
     * @var string
     */
    public $attribute;

    /**
     * @param string $attribute
     * @param Data $fieldDefinition
     * @param ClassDefinition $class
     */
    public function __construct(\OpenDxp\Bundle\DataHubBundle\GraphQL\Service $graphQlService, $attribute, $fieldDefinition, $class)
    {
        $this->attribute = $attribute;
        $this->fieldDefinition = $fieldDefinition;
        $this->class = $class;

        $this->setGraphQLService($graphQlService);
    }

    /**
     * @param BaseDescriptor|null $value
     * @param array $args
     * @param array $context
     *
     * @return ElementDescriptor|null
     *
     * @throws \Exception
     */
    public function resolve($value = null, $args = [], $context = [], ?ResolveInfo $resolveInfo = null)
    {
        $relation = \OpenDxp\Bundle\DataHubBundle\GraphQL\Service::resolveValue($value, $this->fieldDefinition, $this->attribute, $args);

        if ($relation instanceof Asset) {
            if (!WorkspaceHelper::checkPermission($relation, 'read')) {
                return null;
            }

            $data = new ElementDescriptor($relation);
            $this->getGraphQlService()->extractData($data, $relation, $args, $context, $resolveInfo);

            return $data;
        }

        return null;
    }
}
