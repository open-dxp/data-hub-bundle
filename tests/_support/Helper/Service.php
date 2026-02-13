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

namespace OpenDxp\Bundle\DataHubBundle\Tests\Helper;

use OpenDxp;
use OpenDxp\Tests\Support\Helper\Model;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Service extends Model
{
    /**
     * @var null|ContainerBagInterface
     */
    protected static $container = null;

    /**
     * @return object|null
     */
    public function grabService(string $serviceId)
    {

        //TODO change this as soon as OpenDxp helper has grabService method
        if (empty(self::$container)) {
            $container = OpenDxp::getContainer();
            self::$container = $container->has('test.service_container') ? $container->get('test.service_container') : $container;
        }

        return self::$container->get($serviceId);
    }

    public function initializeDefinitions(): void
    {
        //        $this->setupFieldcollection_Unittestfieldcollection();
        //        $this->setupPimcoreClass_Unittest();
        //        $this->setupObjectbrick_UnittestBrick();
    }
}
