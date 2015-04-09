<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {0} of {1} ({2} {3})', ['{{page}}', '{{pages}}', '{{count}}', __('records')])); ?></p>
</div>