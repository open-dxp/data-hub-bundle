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

namespace OpenDxp\Bundle\DataHubBundle\Tests\Controller;

use Codeception\Test\Unit;
use OpenDxp\Bundle\DataHubBundle\Configuration;
use Symfony\Component\HttpFoundation\Request;

class CheckConsumerPermissionsServiceTest extends Unit
{
    const CORRECT_API_KEY = 'correct_key';

    public function testSecurityCheckFailsWhenNoApiKeyInRequest()
    {
        // Arrange
        $configuration = $this->createMock(Configuration::class);
        $configuration->method('getSecurityConfig')
            ->willReturn([
                 'method' => Configuration::SECURITYCONFIG_AUTH_APIKEY,
                 'apikey' => self::CORRECT_API_KEY,
            ]);
        $request = new Request();

        // System under Test
        $sut = new \OpenDxp\Bundle\DataHubBundle\Service\CheckConsumerPermissionsService();
        // Act
        $result = $sut->performSecurityCheck($request, $configuration);
        // Assert
        $this->assertFalse($result);
    }

    public function testSecurityCheckFailsWhenInvalidApiKeyInRequest()
    {
        // Arrange
        $configuration = $this->createMock(Configuration::class);
        $configuration->method('getSecurityConfig')
            ->willReturn([
                'method' => Configuration::SECURITYCONFIG_AUTH_APIKEY,
                'apikey' => self::CORRECT_API_KEY,
            ]);
        $request = new Request(['apikey' => 'wrong_key']);

        // System under Test
        $sut = new \OpenDxp\Bundle\DataHubBundle\Service\CheckConsumerPermissionsService();
        // Act
        $result = $sut->performSecurityCheck($request, $configuration);
        //Assert
        $this->assertFalse($result);
    }

    public function testSecurityCheckPassesWhenCorrectApiKeyInQuery()
    {
        // Arrange
        $configuration = $this->createMock(Configuration::class);
        $configuration->method('getSecurityConfig')
            ->willReturn([
                'method' => Configuration::SECURITYCONFIG_AUTH_APIKEY,
                'apikey' => self::CORRECT_API_KEY,
            ]);
        $request = new Request(['apikey' => self::CORRECT_API_KEY]);

        // System under Test
        $sut = new \OpenDxp\Bundle\DataHubBundle\Service\CheckConsumerPermissionsService();
        // Act
        $result = $sut->performSecurityCheck($request, $configuration);
        // Assert
        $this->assertTrue($result);
    }

    public function testSecurityCheckPassesWhenCorrectApiKeyInApikeyHeader()
    {
        // Arrange
        $configuration = $this->createMock(Configuration::class);
        $configuration->method('getSecurityConfig')
            ->willReturn([
                'method' => Configuration::SECURITYCONFIG_AUTH_APIKEY,
                'apikey' => self::CORRECT_API_KEY,
            ]);
        $request = new Request();
        $request->headers->set('apikey', self::CORRECT_API_KEY);

        // System under Test
        $sut = new \OpenDxp\Bundle\DataHubBundle\Service\CheckConsumerPermissionsService();
        // Act
        $result = $sut->performSecurityCheck($request, $configuration);
        // Assert
        $this->assertTrue($result);
    }

    public function testSecurityCheckPassesWhenCorrectXApiKeyInApikeyHeader()
    {
        // Arrange
        $configuration = $this->createMock(Configuration::class);
        $configuration->method('getSecurityConfig')
            ->willReturn([
                'method' => Configuration::SECURITYCONFIG_AUTH_APIKEY,
                'apikey' => self::CORRECT_API_KEY,
            ]);
        $request = new Request();
        $request->headers->set('X-API-Key', self::CORRECT_API_KEY);
        // System under Test
        $sut = new \OpenDxp\Bundle\DataHubBundle\Service\CheckConsumerPermissionsService();
        // Act
        $result = $sut->performSecurityCheck($request, $configuration);
        // Assert
        $this->assertTrue($result);
    }

    public function testSecurityCheckPrioritizesHeaderOverQueryParam()
    {
        // Arrange
        $configuration = $this->createMock(Configuration::class);
        $configuration->method('getSecurityConfig')
            ->willReturn([
                'method' => Configuration::SECURITYCONFIG_AUTH_APIKEY,
                'apikey' => self::CORRECT_API_KEY,
            ]);
        $request = new Request(['apikey', 'wrong_key']);
        $request->headers->set('apikey', self::CORRECT_API_KEY);
        // System under Test
        $sut = new \OpenDxp\Bundle\DataHubBundle\Service\CheckConsumerPermissionsService();
        // Act
        $result = $sut->performSecurityCheck($request, $configuration);
        // Assert
        $this->assertTrue($result);
    }
}
