<?php
namespace ImboProjectTest\Model;

use ImboProject\Model\Contributor;

class ContributorTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Contributor
     */
    protected $model;

    /**
     * Set up the model
     */
    public function setUp() {
        $this->model = new Contributor();
    }

    /**
     * Tear down the model
     */
    public function tearDown() {
        $this->model = null;
    }

    public function testReturnsNullWhenNotInitialized() {
        $this->assertNull($this->model->getAvatarUrl());
        $this->assertNull($this->model->getUrl());
        $this->assertNull($this->model->getName());
        $this->assertNull($this->model->getContributions());
    }

    public function testReturnsCorrectDataAfterInitialization() {
        $this->model->exchangeArray(array(
            'avatar' => 'http://avatar',
            'url' => 'http://url',
            'name' => 'Christer',
            'login' => 'christeredvartsen',
            'contributions' => 1349,
        ));

        $this->assertSame('http://avatar', $this->model->getAvatarUrl());
        $this->assertSame('http://url', $this->model->getUrl());
        $this->assertSame('Christer', $this->model->getName());
        $this->assertSame(1349, $this->model->getContributions());
    }

    public function testGetNameReturnsLoginIfNameIsEmpty() {
        $this->model->exchangeArray(array(
            'name' => null,
            'login' => 'christeredvartsen',
        ));

        $this->assertSame('christeredvartsen', $this->model->getName());
    }
}
