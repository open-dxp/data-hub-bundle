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

namespace OpenDxp\Bundle\DataHubBundle\Tests\Application\GraphQL;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ElementIdentificationTrait;

/**
 * Loads an element through the trait. Both lookups return their arguments as text.
 */
final class MockElementIdentification
{
    use ElementIdentificationTrait;

    protected function getElementById($type, $id)
    {
        return sprintf('%s %s', $type, $id);
    }

    protected function getElementByPath($type, $fullpath)
    {
        return sprintf('%s %s', $type, $fullpath);
    }
}
