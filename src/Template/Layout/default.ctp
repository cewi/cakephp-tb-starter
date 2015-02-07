<?php

use Cake\Core\Configure;

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Default `html` block.
 */
if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s" class="no-js">', Configure::read('App.language'));
    $this->end();
}

/**
 * Default `title` block.
 */
if (!$this->fetch('title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}

/**
 * Default `footer` block.
 */
if (true) {
    $this->start('tb_footer');
    printf('<div class="row"><div class="col-md-4 col-md-offset-8"><small>&copy; %s %s</small></div></div>', date('Y'), Configure::read('App.author'));
    $this->end();
}

/**
 * Default `body` block.
 */
$this->prepend('tb_body_attrs', ' class="' . implode(' ', array($this->request->controller, $this->request->action)) . '" ');
if (!$this->fetch('tb_body_start')) {
    $this->start('tb_body_start');
    echo '<body' . $this->fetch('tb_body_attrs') . '>';
    $this->end();
}
if (!$this->fetch('tb_body_end')) {
    $this->start('tb_body_end');
    echo '</body>';
    $this->end();
}

/**
 * Prepend `meta` block with `author` and `favicon`.
 */
$this->prepend('meta', $this->Html->meta('author', null, array('name' => 'author', 'content' => Configure::read('App.author'))));
$this->prepend('meta', $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon')));

/**
 * Prepend `css` block with Bootswatch and Icon-Library stylesheets and append
 * the `$html5Shim`.
 */
$html5Shim = <<<HTML
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
HTML;
$this->prepend('css', $this->Html->css([
            '/bower/bootswatch/yeti/bootstrap.min',
            '/bower/fontawesome/css/font-awesome.min',
            '/bower/select2/dist/css/select2.min',
            'icomoon']));
$this->append('css', $html5Shim);

/**
 * Prepend 'js'-Block with jquery, bootstrap and select2 js
 */
$this->prepend('script', $this->Html->script([
            '/bower/jquery/dist/jquery.min',
            '/bower/bootstrap/dist/js/bootstrap.min',
            '/bower/select2/dist/js/select2.min',
            '/bower/select2/dist/js/i18n/de',
            'common'
]));
?>
<!DOCTYPE html>

<?= $this->fetch('html') ?>

<head>

    <?= $this->Html->charset() ?>

    <title><?= $this->fetch('title') ?></title>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>

<?php
echo $this->fetch('tb_body_start');
echo $this->Flash->render();
echo $this->fetch('content');
echo $this->fetch('tb_footer');
echo $this->fetch('script');
echo $this->fetch('tb_body_end');
?>

</html>
