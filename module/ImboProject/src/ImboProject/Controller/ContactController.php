<?php
namespace ImboProject\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

/**
 * Contact controller
 */
class ContactController extends AbstractActionController {
    /**
     * Index action
     */
    public function indexAction() {
        // Fetch the cache adapter and set some options
        $cache = $this->cache();
        $cache->getOptions()->setTtl(60 * 60);

        // Cache key
        $key = 'contributors';

        if ($cache->hasItem($key)) {
            $contributors = $cache->getItem($key);
        } else {
            $contributors = $this->getServiceLocator()->get('github')->getContributors('imbo', 'imbo');
            $cache->setItem($key, $contributors);
        }

        return new ViewModel(array(
            'contributors' => $contributors,
        ));
    }
}
