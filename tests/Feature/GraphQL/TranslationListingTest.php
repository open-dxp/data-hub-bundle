<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Feature\GraphQL;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\QueryType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\TranslationListing;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\Translation;
use OpenDxp\Test\Factory\TranslationFactory;
use OpenDxp\TestFoundation\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;

beforeEach(function () {
    $this->prefix = uniqid('datahub');

    foreach (['one', 'two', 'three'] as $key) {
        TranslationFactory::new()
            ->withTranslations(['en' => 'en ' . $key, 'de' => 'de ' . $key])
            ->create(['key' => $this->prefix . $key]);
    }

    TranslationFactory::new()->admin()
        ->withTranslations(['en' => 'en admin', 'de' => 'de admin'])
        ->create(['key' => $this->prefix . 'admin']);
});

/**
 * @return array<string, Translation>
 */
function listTranslations(array $args): array
{
    $listing = (new TranslationListing(Container::get(Service::class), new EventDispatcher()))->resolveListing([], $args);
    $nodes = [];

    foreach ($listing['edges'] as $edge) {
        $nodes[$edge['cursor']] = $edge['node'];
    }

    return $nodes;
}

it('lists the translations of the default domain with the key as cursor', function () {
    $nodes = listTranslations(['keys' => $this->prefix . 'one']);

    expect(array_keys($nodes))->toBe(['translation-' . $this->prefix . 'one'])
        ->and($nodes['translation-' . $this->prefix . 'one']->getTranslations())->toEqual(['de' => 'de one', 'en' => 'en one']);
});

it('lists the translations of several keys', function () {
    expect(array_keys(listTranslations(['keys' => $this->prefix . 'one,' . $this->prefix . 'three'])))
        ->toEqualCanonicalizing(['translation-' . $this->prefix . 'one', 'translation-' . $this->prefix . 'three']);
});

it('lists the translations of the domain it is asked for', function () {
    expect(array_keys(listTranslations(['domain' => 'admin', 'keys' => $this->prefix . 'admin,' . $this->prefix . 'one'])))
        ->toBe(['translation-' . $this->prefix . 'admin']);
});

it('returns only the languages it is asked for', function (string $languages, array $expected) {
    $nodes = listTranslations(['keys' => $this->prefix . 'two', 'languages' => $languages]);

    expect(array_keys(reset($nodes)->getTranslations()))->toEqualCanonicalizing($expected);
})->with([
    'one language' => ['en', ['en']],
    'several languages' => ['en, de', ['en', 'de']],
]);

it('asks for the key of a single translation', function () {
    (new QueryType(new EventDispatcher()))->resolveTranslationGetter();
})->throws(\Exception::class, 'Argument key is mandatory');
