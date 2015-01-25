<div class="paginator row">
    <div class="col-lg-6 col-sm-9">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
    </div>
    <div class="col-lg-6 col-sm-3">
        <p><small>(<?= $this->Paginator->counter(__('Page {0} of {1}', '{{page}}', '{{pages}}')); ?>)</small></p>
    </div>
</div>