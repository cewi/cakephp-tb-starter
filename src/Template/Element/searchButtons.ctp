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
<?= $this->Form->button(__('Reset'), ['type'=>'reset', 'class'=>'btn btn-sm btn-info', 'icon'=>'glyphicon-off']);?>