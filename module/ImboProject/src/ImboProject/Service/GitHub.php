<?php
namespace ImboProject\Service;

use ImboProject\Model\Contributor,
    Zend\ServiceManager,
    Guzzle\Http\Client,
    Guzzle\Plugin\Oauth\OauthPlugin;

/**
 * GitHub service class
 */
class GitHub implements ServiceManager\ServiceLocatorAwareInterface {
    use ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @var Client
     */
    private $client;

    /**
     * Class constructor
     *
     * @param Client $client A Guzzle client to use for API requests
     * @param string $oauth The oauth token to use
     */
    public function __construct(Client $client, $oauth) {
        $client->setBaseUrl('https://api.github.com/');
        $client->setDefaultHeaders(array(
            'Authorization' => 'bearer ' . $oauth,
        ));

        $this->client = $client;
    }

    /**
     * Fetch a list of contributors for the imbo repository
     *
     * @param string $org The organization
     * @param string $repos The repository name
     * @return Contributor[]
     */
    public function getContributors($org, $repos) {
        $path = sprintf('/repos/%s/%s/contributors', $org, $repos);
        $response = $this->client->get($path)->send()->json();

        $contributors = array();

        foreach ($response as $entry) {
            $user = $this->getUserInfo($entry['login']);

            $contributor = new Contributor();
            $contributor->exchangeArray(array(
                'avatar' => $user['avatar_url'],
                'url' => $user['html_url'],
                'name' => isset($user['name']) ? $user['name'] : null,
                'login' => $entry['login'],
                'contributions' => $entry['contributions'],
            ));

            $contributors[] = $contributor;
        }

        return $contributors;
    }

    /**
     * Fetch information about a single user
     *
     * @param string $login The login name of the user
     * @return array
     */
    private function getUserInfo($login) {
        $path = sprintf('/users/%s', $login);

        return $this->client->get($path)->send()->json();
    }
}
