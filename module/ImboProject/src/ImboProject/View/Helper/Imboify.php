<?php
namespace ImboProject\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Imboify view helper
 *
 * This view helper attached some classes to the letters in the text, which is styled to have some
 * different shades of the Imbo green.
 */
class Imboify extends AbstractHelper {
    /**
     * The classes to apply
     *
     * @var array
     */
    private $classes = array(
        'i',
        'm',
        'b',
        'o',
        'ii',
        'mm',
        'bb',
        'oo',
    );

    /**
     * Main helper logic
     *
     * @param string $value The value to Imboify
     * @return string
     */
    public function __invoke($value) {
        $result = '';

        for ($i = 0; $i < strlen($value); $i++) {
            if (trim($value[$i]) === '') {
                $result .= ' ';
            } else {
                $result .= sprintf(
                    '<span class="%s">%s</span>',
                    $this->classes[$i % count($this->classes)], $value[$i]
                );
            }
        }

        return $result;
    }
}
