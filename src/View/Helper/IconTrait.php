<?php

namespace Cewi\CakephpTbStarter\View\Helper;

use Cake\Core\Configure;

trait IconTrait
{

    /**
     * span-tag with the icon
     *
     * @access protected
     * @since 04.01.2015
     * @param string $iconName
     * @return string
     */
    protected function _icon($iconName = '')
    {
        $out = '';
        $parts = preg_split('/\-/', $iconName);
        if (in_array($parts[0], Configure::read('CakephpTbStarter.fonts'))) {
            $out .= '<span class="' . $parts[0] . ' ' . $iconName . '" aria-hidden="true"></span>';
        }
        return $out;
    }

}
