<?php
namespace ImboProject\Model;

use Zend\Stdlib\ArraySerializableInterface;

/**
 * Contributor model
 */
class Contributor implements ArraySerializableInterface {
    /**
     * Contributor data
     *
     * @var array
     */
    private $data = array();

    /**
     * {@inheritdoc}
     */
    public function exchangeArray(array $data) {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getArrayCopy() {
        return $this->data;
    }

    /**
     * Fetch the URL of the avatar for this user
     *
     * @return string|null
     */
    public function getAvatarUrl() {
        return isset($this->data['avatar']) ? $this->data['avatar'] : null;
    }

    /**
     * Fetch the URL to this user
     *
     * @return string|null
     */
    public function getUrl() {
        return isset($this->data['url']) ? $this->data['url'] : null;
    }

    /**
     * Fetch the name of this user
     *
     * @return string|null
     */
    public function getName() {
        if (!empty($this->data['name'])) {
            return $this->data['name'];
        }

        return $this->getLogin();
    }

    /**
     * Get the number of contributions this user has made
     *
     * @return int|null
     */
    public function getContributions() {
        return isset($this->data['contributions']) ? (int) $this->data['contributions'] : null;
    }

    /**
     * Get the user login
     *
     * @return string|null
     */
    public function getLogin() {
        return isset($this->data['login']) ? $this->data['login'] : null;
    }
}
