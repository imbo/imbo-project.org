<?php
namespace ImboProjectTest;

use Zend\Mvc\Service\ServiceManagerConfig,
    Zend\ServiceManager\ServiceManager;

require __DIR__ . '/../vendor/autoload.php';

class Bootstrap {
    public static function init() {
        if (is_readable(__DIR__ . '/TestConfig.php')) {
            $testConfig = include __DIR__ . '/TestConfig.php';
        } else {
            $testConfig = include __DIR__ . '/TestConfig.php.dist';
        }

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $testConfig)
                       ->get('ModuleManager')->loadModules();
    }
}

Bootstrap::init();
