<?php
namespace ImboProject\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

/**
 * Docs controller
 */
class DocsController extends AbstractActionController {
    /**
     * Index action
     */
    public function indexAction() {
        return new ViewModel();
    }
}
