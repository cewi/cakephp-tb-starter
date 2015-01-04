<?php

namespace Cewi\CakephpTbStarter\View\Helper;

use Cake\View\Helper;

/*
 * The MIT License
 *
 * Copyright 2015 wichmanc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * CakePHP IconHelper
 *
 * creates markup for iconic fonts like FontAwesome, Icomonn oder Glyphicons provided
 * by TwitterBootstrap 3. CSS for Icon-fonts must be included in layout
 *
 * @author cewi
 */
class IconHelper extends Helper
{
    /* Helpers */

    public $helpers = ['Html', 'Form'];

    /**
     * available Icon-Font-Types
     * needs to be adapted according your needs
     *
     * @var array
     */
    protected $_fonts = ['icomoon' => 'icon', 'fontawesome' => 'fa', 'bootstrap' => 'glyphicon'];

    /**
     * assign icons to actions
     *
     * @var array
     */
    protected $_icons_for_actions = [
        'edit' => 'glyphicon-pencil',
        'view' => 'glyphicon-zoom-in',
        'add' => 'glyphicon-plus-sign',
        'delete' => 'glyphicon-warning-sign',
        'index' => 'glyphicon-list'
    ];

    /**
     * prints out an span with the icon
     *
     * @access public
     * @since 04.01.2015
     * @param string $iconName
     * @return string
     */
    public function span($iconName = '')
    {
        $out = '';
        $parts = preg_split('/\-/', $iconName);
        if (in_array($parts[0], $this->_fonts)) {
            $out .= '<span class="' . $parts[0] . ' ' . $iconName . '" aria-hidden="true"></span>';
        }
        return $out;
    }

    /**
     * Converts "normal" links in iconified links
     * title is converted to an icon depending on action name
     *
     * @access public
     * @since 04.01.2015
     * @param string $title
     * @param type $url
     * @param array $options Options. If keepTitle is set, icon will be added to the original title.
     * @return string
     */
    public function link($title, $url = null, array $options = [])
    {
        if (isset($url['action']) && in_array($url['action'], array_keys($this->_icons_for_actions))) {
            $options['escape'] = FALSE;
            $options['title'] = $title;
            if (isset($options['keepTitle']) && $options['keepTitle']) {
                $title = $this->span($this->_icons_for_actions[$url['action']]) . '&nbsp;' . $title;
                unset($options['keepTitle']);
            } else {
                $title = '<span class="sr-only">' . $title . '</span>' . $this->span($this->_icons_for_actions[$url['action']]);
            }
        };
        return $this->Html->link($title, $url, $options);
    }

    /**
     * Converts "normal" postLinks in iconified postLinks
     * title is converted to an icon depending on action name
     * if $option keetTitle is set, icon will be added to teh original title.
     *
     * @access public
     * @since 04.01.2015
     * @param string $title
     * @param type $url
     * @param array $options Options. If keepTitle is set, icon will be added to the original title.
     * @return string
     */
    public function postLink($title, $url = null, array $options = [])
    {
        if (isset($url['action']) && in_array($url['action'], array_keys($this->_icons_for_actions))) {
            $options['escape'] = FALSE;
            $options['title'] = $title;
            if (isset($options['keepTitle']) && $options['keepTitle']) {
                $title = $this->span($this->_icons_for_actions[$url['action']]) . ' ' . $title;
                unset($options['keepTitle']);
            } else {
                $title = '<span class="sr-only">' . $title . '</span>' . $this->span($this->_icons_for_actions[$url['action']]);
            }
        };
        return $this->Form->postLink($title, $url, $options);
    }

}
