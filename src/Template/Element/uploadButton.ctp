<?php
/**
 * CakePHP(TM)-View-Element
 *
 * elements/upload.ctp
 *
 * @author        cewi <c.wichmann@gmx.de>
 * @since 01.02.2015
 * @package vpa9
 */
?>
<!--- Jasny Bootstrap File-upload widget ---->
<?= $this->Html->css('/bower/jasny-bootstrap/dist/css/jasny-bootstrap.min', ['block'=>true]); ?>
<div class="fileinput fileinput-new" data-provides="fileinput">
  <span class="btn btn-default btn-sm btn-file">
      <span class="fileinput-new"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;<?= __('Select {0}', __('File')); ?></span>
      <span class="fileinput-exists"><span class="glyphicon glyphicon-random"></span>&nbsp;<?= __('Change'); ?></span>
      <input type="file" name="file"></span>
  <span class="fileinput-filename"></span>
  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&nbsp;&times;</a>
</div>
<?= $this->Html->script('/bower/jasny-bootstrap/dist/js/jasny-bootstrap.min', ['block'=>true]); ?>