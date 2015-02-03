&nbsp;
<?=
$this->Form->button( __('Filter'), [
    'type' => 'submit',
    'label' => false,
    'div' => false,
    'icon' => 'glyphicon-filter',
    'class' => 'btn btn-sm btn-primary']);
?>
&nbsp;
<?= $this->Html->link(__('Reset'), ['action' => $this->request->action], ['icon' => 'glyphicon-off', 'class' => 'btn btn-sm btn-info']); ?>