<?php

/**
 * Geolocation Developer Toolbar (http://mateuszsitek.com/projects/geolocation-developer-toolbar)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\Developer\Toolbar\Geolocation\Collector;

use Aist\Geolocation\Entity\Location;
use Aist\Geolocation\Service\GeolocationService;
use Zend\Mvc\MvcEvent;
use ZendDeveloperTools\Collector\CollectorInterface;

/**
 * Data Collector
 */
class GeolocationCollector implements CollectorInterface
{
    /**
     * Collector Icon
     *
     * @var string
     */
    private $icon;

    /**
     * @var Location
     */
    private $location;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'geolocation.toolbar';
    }

    /**
     * {@inheritDoc}
     */
    public function getPriority()
    {
        return PHP_INT_MAX;
    }

    /**
     * @inheritdoc
     */
    public function collect(MvcEvent $mvcEvent)
    {
        if (! $application = $mvcEvent->getApplication()) {
            return;
        }

        $serviceManager = $application->getServiceManager();

        $geolocationService = $serviceManager->get(GeolocationService::class);

        /** @var Location $location */
        $location = $geolocationService->getLocation();

        $icons = include __DIR__ . '/../../data/icons.php';

        if (empty($location->getCountryCode())) {
            $this->icon = $icons['unknown'];
        } else {
            $this->icon = $icons['on'];
        }

        $this->location = $location;
    }

    /**
     * Collector Icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }
}
