<?php
/**
 * This file is part of the imbo-project.org package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace ImboProject;

use Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * Main ImboProject module
 */
class Module implements ConfigProviderInterface, AutoloaderProviderInterface {
    /**
     * {@inheritdoc}
     */
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * {@inheritdoc}
     */
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
