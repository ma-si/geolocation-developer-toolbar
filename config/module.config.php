<?php

/**
 * Geolocation Developer Toolbar (http://mateuszsitek.com/projects/geolocation-developer-toolbar)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

return [
    'service_manager' => [
        'invokables' => [
            'geolocation.toolbar' => \Aist\Developer\Toolbar\Geolocation\Collector\GeolocationCollector::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'template_map' => [
            'zend-developer-tools/toolbar/geolocation-data' => __DIR__ . '/../view/zend-developer-tools/toolbar/geolocation-data.phtml',
        ],
    ],
    'zenddevelopertools' => [
        'profiler' => [
            'collectors' => [
                'geolocation.toolbar' => 'geolocation.toolbar',
            ],
        ],
        'toolbar' => [
            'entries' => [
                'geolocation.toolbar' => 'zend-developer-tools/toolbar/geolocation-data',
            ],
        ],
    ],
];
