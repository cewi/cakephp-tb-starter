<?php
/**
 * CakePHP(TM)-View-Element
 *
 * elements/upload.ctp
 *
 * @copyright     Voll-Komm Dieter Voll
 * @link          http://voll-komm.de
 * @author        cewi <c.wichmann@gmx.de>
 * @since 01.02.2015
 * @package vpa9
 */
?>
<!--- Jasny Bootstrap File-upload widget ---->
<?= $this->Html->css('/bower/jasny-bootstrap/dist/css/jasny-bootstrap.min', ['block'=>true]); ?>
<div class="fileinput fileinput-new input-group" data-provides="fileinput">
    <div class="form-control" data-trigger="fileinput">
        <i class="glyphicon glyphicon-file fileinput-exists"></i>
        <span class="fileinput-filename"></span>
    </div>
    <span class="input-group-addon btn btn-default btn-file">
        <span class="fileinput-new"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;<?= __('Select {0}', __('File')); ?></span>&nbsp;
        <span class="fileinput-exists"><span class="glyphicon glyphicon-random"></span>&nbsp;<?= __('Change'); ?></span>
        <?= $this->Form->file('file', ['div' => false]); ?>
    </span>
    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span>&nbsp;<?= __('Remove'); ?></a>
</div>
<br/>
<?= $this->Html->script('/bower/jasny-bootstrap/dist/js/jasny-bootstrap.min', ['block' => true]); ?>