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
    protected function _span($iconName = '')
    {
        $out = '';
        $parts = preg_split('/\-/', $iconName);
        if (in_array($parts[0], Configure::read('CakephpTbStarter.fonts'))) {
            $out .= '<span class="' . $parts[0] . ' ' . $iconName . '" aria-hidden="true"></span>';
        }
        return $out;
    }

    /**
     * changing Options
     *
     * @access public
     * @since 06.01.2015
     * @todo more options, i.e. tooltips
     * @param array $options
     * @return arry
     */
    protected function _changeOptions($options)
    {
        unset($options['icon']);
        $options['escape'] = FALSE;
        $options['title'] = $title;
        return $options;
    }

}
