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

namespace OpenDxp\Bundle\DataHubBundle\Tests\Feature\GraphQL;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\BlockEntryType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data\Block;
use OpenDxp\Model\DataObject\ClassDefinition\Data\Input;
use OpenDxp\TestFoundation\Container;

it('builds the entry type of a block field', function () {
    $headline = new Input();
    $headline->setName('headline');
    $block = new Block();
    $block->setName('content');
    $block->setChildren([$headline]);
    $class = new ClassDefinition();
    $class->setName('unittest');

    $type = new BlockEntryType(Container::get(Service::class), $block, $class);

    expect($type->getFieldNames())->toBe(['headline']);
});
