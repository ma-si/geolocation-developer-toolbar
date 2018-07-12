<?php

/**
 * Geolocation Developer Toolbar (http://mateuszsitek.com/projects/geolocation-developer-toolbar)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Test\Aist\Developer\Toolbar\Geolocation\Collector;

use Aist\Developer\Toolbar\Geolocation\Collector\GeolocationCollector;
use Aist\Geolocation\Entity\Location;
use Aist\Geolocation\Service\GeolocationService;
use PHPUnit\Framework\TestCase;
use Zend\Mvc;
use Zend\ServiceManager;

class GeolocationCollectorTest extends TestCase
{
    public function testGetName()
    {
        $collector = new GeolocationCollector();
        $name = $collector->getName();

        $this->assertSame('geolocation.toolbar', $name);
    }

    public function testGetPriority()
    {
        $collector = new GeolocationCollector();
        $priority = $collector->getPriority();

        $this->assertTrue(is_int($priority));
    }

    public function testCollect()
    {
        $collector = new GeolocationCollector();

        $mvcEvent = $this->getMockBuilder(Mvc\MvcEvent::class)
            ->getMock();
        $application = $this->getMockBuilder(Mvc\Application::class)
            ->disableOriginalConstructor()
            ->getMock();
        $serviceManager = $this->getMockBuilder(ServiceManager\ServiceManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $geolocationService = $this->getMockBuilder(GeolocationService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $location = $this->getMockBuilder(Location::class)
            ->disableOriginalConstructor()
            ->getMock();

        $geolocationService
            ->expects($this->once())
            ->method("getLocation")
            ->willReturn($location);

        $serviceManager
            ->expects($this->once())
            ->method("get")
            ->with(GeolocationService::class)
            ->willReturn($geolocationService);

        $application
            ->expects($this->once())
            ->method("getServiceManager")
            ->willReturn($serviceManager);

        $mvcEvent->method("getApplication")->willReturn($application);

        $collector->collect($mvcEvent);
    }
}
