<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Feature\GraphQL;

use Exception;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\QueryType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\TranslationListing;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\Translation;
use OpenDxp\Test\Factory\TranslationFactory;
use OpenDxp\TestFoundation\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;

beforeEach(function () {
    $prefix = uniqid('datahub');
    $this->one = sprintf('%sone', $prefix);
    $this->two = sprintf('%stwo', $prefix);
    $this->three = sprintf('%sthree', $prefix);
    $this->admin = sprintf('%sadmin', $prefix);

    foreach (['one', 'two', 'three'] as $name) {
        TranslationFactory::new()
            ->withTranslations([
                'en' => sprintf('en %s', $name),
                'de' => sprintf('de %s', $name),
            ])
            ->create(['key' => $this->{$name}]);
    }

    TranslationFactory::new()
        ->inAdminDomain()
        ->withTranslations([
            'en' => 'en admin',
            'de' => 'de admin',
        ])
        ->create(['key' => $this->admin]);
});

/**
 * @param array<string, string> $arguments
 *
 * @return array<string, Translation> the listed translations by their cursor
 */
function listTranslations(array $arguments): array
{
    $resolver = new TranslationListing(Container::get(Service::class), new EventDispatcher());
    $nodes = [];

    foreach ($resolver->resolveListing([], $arguments)['edges'] as $edge) {
        $nodes[$edge['cursor']] = $edge['node'];
    }

    return $nodes;
}

function cursorOf(string $key): string
{
    return sprintf('translation-%s', $key);
}

it('lists the translations of the default domain with the key as cursor', function () {
    $nodes = listTranslations(['keys' => $this->one]);

    expect(array_keys($nodes))
        ->toBe([cursorOf($this->one)])
        ->and($nodes[cursorOf($this->one)]->getTranslations())
        ->toEqual([
            'de' => 'de one',
            'en' => 'en one',
        ]);
});

it('lists the translations of several keys', function () {
    $nodes = listTranslations(['keys' => sprintf('%s,%s', $this->one, $this->three)]);

    expect(array_keys($nodes))->toEqualCanonicalizing([
        cursorOf($this->one),
        cursorOf($this->three),
    ]);
});

it('lists the translations of the domain it is asked for', function () {
    $nodes = listTranslations([
        'domain' => 'admin',
        'keys' => sprintf('%s,%s', $this->admin, $this->one),
    ]);

    expect(array_keys($nodes))->toBe([cursorOf($this->admin)]);
});

it('returns only the languages it is asked for', function (string $languages, array $expected) {
    $nodes = listTranslations([
        'keys' => $this->two,
        'languages' => $languages,
    ]);

    expect(array_keys(reset($nodes)->getTranslations()))->toEqualCanonicalizing($expected);
})->with([
    'one language' => ['en', ['en']],
    'several languages' => ['en, de', ['en', 'de']],
]);

it('asks for the key of a single translation', function () {
    (new QueryType(new EventDispatcher()))->resolveTranslationGetter();
})->throws(Exception::class, 'Argument key is mandatory');
