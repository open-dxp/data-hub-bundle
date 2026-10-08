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

namespace OpenDxp\Bundle\DataHubBundle\Tests\Unit\GraphQL;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Exception\ClientSafeException;
use OpenDxp\Bundle\DataHubBundle\Tests\Application\GraphQL\MockElementIdentification;

it('asks for the type of the element', function () {
    (new MockElementIdentification())->getElementByTypeAndIdOrPath([]);
})->throws(ClientSafeException::class, 'type expected');

it('refuses a type it does not support', function () {
    (new MockElementIdentification())->getElementByTypeAndIdOrPath(['type' => 'wrong']);
})->throws(ClientSafeException::class, 'The type "wrong" is not supported');

it('asks for an id or a full path', function () {
    (new MockElementIdentification())->getElementByTypeAndIdOrPath(['type' => 'object']);
})->throws(ClientSafeException::class, 'either id or fullpath expected');

it('refuses an id and a full path together', function () {
    (new MockElementIdentification())->getElementByTypeAndIdOrPath([
        'type' => 'object',
        'id' => 4,
        'fullpath' => '/some/path',
    ]);
})->throws(ClientSafeException::class, 'either id or fullpath expected but not both');

it('finds an element by its full path', function () {
    $element = (new MockElementIdentification())->getElementByTypeAndIdOrPath([
        'type' => 'object',
        'fullpath' => '/some/path',
    ]);

    expect($element)->toBe('object /some/path');
});

it('finds an element by its id', function () {
    $element = (new MockElementIdentification())->getElementByTypeAndIdOrPath([
        'type' => 'object',
        'id' => 4,
    ]);

    expect($element)->toBe('object 4');
});

it('takes the type as a separate argument', function () {
    $element = (new MockElementIdentification())->getElementByTypeAndIdOrPath(['fullpath' => '/some/path'], 'object');

    expect($element)->toBe('object /some/path');
});
