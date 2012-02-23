<?php
namespace ImboProject\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Generate a script tag for a gist
 */
class Gist extends AbstractHelper {
    /**
     * Invoke the helper
     *
     * @param int $id The ID of the gist
     * @return string A script tag
     */
    public function __invoke($id) {
        return sprintf('<script src="https://gist.github.com/%d.js"></script>', (int) $id);
    }
}
