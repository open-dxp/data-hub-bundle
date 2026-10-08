<?php

declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\Tests\Feature\Configuration;

use OpenDxp\Bundle\DataHubBundle\Configuration;

it('saves a configuration and finds it by its name', function () {
    $name = uniqid('datahub');
    $fixture = (string) file_get_contents(dirname(__DIR__, 2) . '/Fixtures/configurations/query-and-mutation.json');
    $configuration = new Configuration('graphql', '/', $name);
    $configuration->setConfiguration(json_decode($fixture, true));

    $configuration->save();

    expect(Configuration::getByName($name)?->getQueryEntities())->toBe(['DataHubTestEntity']);
});
