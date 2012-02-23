<?php
namespace ImboProjectTest\View\Helper;

use ImboProject\View\Helper\Imboify;

class ImboifyTest extends \PHPUnit_Framework_TestCase {
    public function testHelper() {
        $helper = new Imboify();
        $this->assertSame(
            '<span class="i">s</span><span class="m">o</span><span class="b">m</span><span class="o">e</span> <span class="mm">s</span><span class="bb">t</span><span class="oo">r</span><span class="i">i</span><span class="m">n</span><span class="b">g</span>',
            $helper('some string')
        );
    }
}
