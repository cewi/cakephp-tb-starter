<?php

namespace Cewi\CakephpTbStarter\View\Helper;

use BootstrapUI\View\Helper\FormHelper as Helper;
use Cake\View\View;

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
 * CakePHP FormHelper
 * @author wichmanc
 */
class FormHelper extends Helper
{

    use IconTrait;

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
        if (isset($options['icon']) && !empty($options['icon'])) {
            $options['title'] = $title;
            $title = $this->_icon($options['icon']);
            if (!isset($options['short']) || $options['short'] == false) {
                $title .= '&nbsp;' . $options['title'];
                unset($options['short']);
            }
            unset($options['icon']);
            $options['escape'] = FALSE;
            /** tootltip */
            $options['data-toggle'] = "tooltip";
            $options['data-placement'] = "top";
        };
        return parent::postLink($title, $url, $options);
    }

}
