&nbsp;
<?=
$this->Form->button('<span class="glyphicon glyphicon-filter"></span> ' . __('Filter'), [
    'type' => 'submit',
    'escape' => false,
    'label' => false,
    'div' => false,
    'class' => 'btn btn-sm btn-primary']);
?>
&nbsp;
<?= $this->Html->link(__('Reset'), ['action' => $this->request->action], ['icon' => 'glyphicon-off', 'class' => 'btn btn-sm btn-info']); ?>