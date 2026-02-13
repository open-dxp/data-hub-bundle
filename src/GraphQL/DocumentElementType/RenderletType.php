<?php

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

namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\Document\Editable\Renderlet;

class RenderletType extends ObjectType
{
    protected static $instance;

    /**
     * @return RenderletType
     *
     * @throws \Exception
     */
    public static function getInstance(Service $graphQlService)
    {
        if (!self::$instance) {
            $anyTargetType = $graphQlService->buildGeneralType('anytarget');

            $config = [
                'name' => 'document_editableRenderlet',
                'fields' => [
                    '_editableType' => [
                        'type' => Type::string(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ?ResolveInfo $resolveInfo = null) {
                            if ($value instanceof Renderlet) {
                                return $value->getType();
                            }
                        },
                    ],
                    '_editableName' => [
                        'type' => Type::string(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ?ResolveInfo $resolveInfo = null) {
                            if ($value instanceof Renderlet) {
                                return $value->getName();
                            }
                        },
                    ],
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ?ResolveInfo $resolveInfo = null) {
                            if ($value instanceof Renderlet) {
                                return $value->getId();
                            }
                        },
                    ],
                    'type' => [
                        'type' => Type::string(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ?ResolveInfo $resolveInfo = null) {
                            if ($value instanceof Renderlet) {
                                return $value->getType();
                            }
                        },
                    ],
                    'subtype' => [
                        'type' => Type::string(),
                        'resolve' => static function ($value = null, $args = [], $context = [], ?ResolveInfo $resolveInfo = null) {
                            if ($value instanceof Renderlet) {
                                return $value->getSubtype();
                            }
                        },
                    ],
                    'relation' => [
                        'type' => $anyTargetType,
                        'resolve' => static function ($value = null, $args = [], $context = [], ?ResolveInfo $resolveInfo = null) use ($graphQlService) {
                            if ($value instanceof Renderlet) {
                                $target = $value->getO();
                                if ($target) {
                                    $desc = new ElementDescriptor($target);
                                    $graphQlService->extractData($desc, $target, $args, $context, $resolveInfo);

                                    return $desc;
                                }
                            }
                        },
                    ],
                ],
            ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
