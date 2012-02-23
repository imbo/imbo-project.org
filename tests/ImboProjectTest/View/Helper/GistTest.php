<?php
namespace ImboProjectTest\View\Helper;

use ImboProject\View\Helper\Gist;

class GistTest extends \PHPUnit_Framework_TestCase {
    public function testHelper() {
        $gist = new Gist();
        $this->assertSame('<script src="https://gist.github.com/123.js"></script>', $gist(123));
    }
}
