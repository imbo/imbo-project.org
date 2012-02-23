<?php
namespace ImboProject\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin,
    Zend\Cache\Storage\Adapter\Memcached;

/**
 * Cache plugin
 *
 * This plugin enables controllers to fetch a cache adapter by simply calling $this->cache()
 */
class Cache extends AbstractPlugin {
    /**
     * Direct invocation method
     *
     * @return Memcached
     */
    public function __invoke() {
        return $this->getController()->getServiceLocator()->get('memcached');
    }
}
