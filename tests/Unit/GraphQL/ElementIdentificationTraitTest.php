<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Unit\GraphQL;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Exception\ClientSafeException;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ElementIdentificationTrait;

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
    elementIdentification()->getElementByTypeAndIdOrPath(['type' => 'object', 'id' => 4, 'fullpath' => '/some/path']);
})->throws(ClientSafeException::class, 'either id or fullpath expected but not both');

it('finds an element by its full path', function () {
    expect(elementIdentification()->getElementByTypeAndIdOrPath(['type' => 'object', 'fullpath' => '/some/path']))
        ->toBe('object /some/path');
});

it('finds an element by its id', function () {
    expect(elementIdentification()->getElementByTypeAndIdOrPath(['type' => 'object', 'id' => 4]))
        ->toBe('object 4');
});

it('takes the type as a separate argument', function () {
    expect(elementIdentification()->getElementByTypeAndIdOrPath(['fullpath' => '/some/path'], 'object'))
        ->toBe('object /some/path');
});
