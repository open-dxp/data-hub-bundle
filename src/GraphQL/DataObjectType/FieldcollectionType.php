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

namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\UnionType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\FieldcollectionDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Cache\RuntimeCache;

class FieldcollectionType extends UnionType
{
    use ServiceTrait;

    protected $types;

    /**
     * @param array $config
     */
    public function __construct(Service $graphQlService, $config = [])
    {
        $this->types = $config['types'];
        $this->setGraphQLService($graphQlService);

        parent::__construct($config);
    }

    /**
     *
     * @throws \Exception
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    public function resolveType($element, $context, ResolveInfo $info)
    {
        if ($element instanceof FieldcollectionDescriptor) {
            $fcName = $element['__fcType'];
            $fcKey = 'graphql_fieldcollection_' . $fcName;
            $type = RuntimeCache::get($fcKey);

            return $type;
        }

        return null;
    }
}
