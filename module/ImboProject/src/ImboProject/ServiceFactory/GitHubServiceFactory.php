<?php
namespace ImboProject\ServiceFactory;

use ImboProject\Service\GitHub as GitHubService,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for creating the GitHub service
 */
class GitHubServiceFactory implements FactoryInterface {
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get('config')['github'];
        $client = $serviceLocator->get('guzzle');

        return new GitHubService(
            $client,
            $config['oauth']
        );
    }
}
