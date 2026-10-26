<?php

declare(strict_types=1);

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
