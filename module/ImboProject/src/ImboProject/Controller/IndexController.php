<?php
namespace ImboProject\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Imbo\Service\ImboClientAware,
    Imbo\Service\ImboClientAwareInterface;

/**
 * Index controller
 */
class IndexController extends AbstractActionController implements ImboClientAwareInterface {
    use ImboClientAware;

    /**
     * Index action
     */
    public function indexAction() {
        $imboClient = $this->getImboClient();

        $userInfo = $imboClient->getUserInfo();
        $userInfo['lastModified'] = $userInfo['lastModified']->format('D, d M Y H:i:s') . ' GMT';

        $serverStatus = $imboClient->getServerStatus();
        $metadata = $imboClient->getMetadata('748ac5c3f937f8d09877887743418908');

        return new ViewModel(array(
            'userInfo' => $userInfo,
            'serverStatus' => $serverStatus,
            'metadata' => $metadata,
        ));
    }
}
