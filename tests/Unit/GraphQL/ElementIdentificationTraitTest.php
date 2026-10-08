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
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ElementIdentificationTrait;

/**
 * The trait loads an element through two methods of its class. Here both methods return their arguments as text.
 */
function elementIdentification(): object
{
    return new class() {
        use ElementIdentificationTrait;

        protected function getElementById($type, $id)
        {
            return sprintf('%s %s', $type, $id);
        }

        protected function getElementByPath($type, $fullpath)
        {
            return sprintf('%s %s', $type, $fullpath);
        }
    };
}

it('asks for the type of the element', function () {
    elementIdentification()->getElementByTypeAndIdOrPath([]);
})->throws(ClientSafeException::class, 'type expected');

it('refuses a type it does not support', function () {
    elementIdentification()->getElementByTypeAndIdOrPath(['type' => 'wrong']);
})->throws(ClientSafeException::class, 'The type "wrong" is not supported');

it('asks for an id or a full path', function () {
    elementIdentification()->getElementByTypeAndIdOrPath(['type' => 'object']);
})->throws(ClientSafeException::class, 'either id or fullpath expected');

it('refuses an id and a full path together', function () {
    elementIdentification()->getElementByTypeAndIdOrPath([
        'type' => 'object',
        'id' => 4,
        'fullpath' => '/some/path',
    ]);
})->throws(ClientSafeException::class, 'either id or fullpath expected but not both');

it('finds an element by its full path', function () {
    $element = elementIdentification()->getElementByTypeAndIdOrPath([
        'type' => 'object',
        'fullpath' => '/some/path',
    ]);

    expect($element)->toBe('object /some/path');
});

it('finds an element by its id', function () {
    $element = elementIdentification()->getElementByTypeAndIdOrPath([
        'type' => 'object',
        'id' => 4,
    ]);

    expect($element)->toBe('object 4');
});

it('takes the type as a separate argument', function () {
    $element = elementIdentification()->getElementByTypeAndIdOrPath(['fullpath' => '/some/path'], 'object');

    expect($element)->toBe('object /some/path');
});
