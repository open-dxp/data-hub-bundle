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

namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\OpenDxpDataHubBundle;
use OpenDxp\Model\Asset;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class Image extends Base
{
    /**
     * @param Concrete|AbstractData $object
     * @param array $newValue
     * @param array $args
     * @param array $context
     *
     * @return void|null
     *
     * @throws \Exception
     */
    public function process($object, $newValue, $args, $context, ResolveInfo $info)
    {
        $attribute = $this->getAttribute();

        if (!array_key_exists('id', $newValue)) {
            if (OpenDxpDataHubBundle::getNotAllowedPolicy() == OpenDxpDataHubBundle::NOT_ALLOWED_POLICY_EXCEPTION) {
                throw new UserError("Field {$attribute}.id was not provided.");
            }

            return null;
        }

        Service::setValue($object, $attribute, function ($container, $setter) use ($newValue) {
            $image = null;

            if (isset($newValue['id'])) {
                $asset = Asset::getById($newValue['id']);
                if ($asset instanceof Asset\Image) {
                    $image = $asset;
                }
            }

            return $container->$setter($image);
        });
    }
}
