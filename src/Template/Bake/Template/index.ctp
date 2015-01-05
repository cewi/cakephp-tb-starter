<%

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;
%>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Icon->link(__('New {0}', ['<%= $singularHumanName %>']), ['action' => 'add'], ['keepTitle' => true]); ?></li>
    <%
    $done = [];
    foreach ($associations as $type => $data):
        foreach ($data as $alias => $details):
            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)):
                %>
    <li><?= $this->Icon->link(__('List {0}', ['<%= Inflector::humanize($details["controller"]) %>']), ['controller' => '<%= $details["controller"] %>', 'action' => 'index'], ['keepTitle' => true]); ?></li>
                <%
                $done[] = $details['controller'];
            endif;
        endforeach;
    endforeach;
    %>
</ul>
<?php $this->end(); ?>
<%
$fields = collection($fields)
        ->filter(function($field) use ($schema) {
            return !in_array($schema->columnType($field), ['binary', 'text']);
        })
        ->take(7);
%>
<h2><?= h('<%= ucfirst($pluralVar) %>') ?></h2>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <% foreach ($fields as $field): %>
            <th><?= $this->Paginator->sort('<%= $field %>'); ?></th>
            <% endforeach; %>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
        <tr>
            <%
            foreach ($fields as $field) {
                $isKey = false;
                if (!empty($associations['BelongsTo'])) {
                    foreach ($associations['BelongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
                            %>
            <td>
                                <?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?>
                            </td>
                            <%
                            break;
                        }
                    }
                }
                if ($isKey !== true) {
                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                        %>
            <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                        <%
                    } else {
                        %>
            <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
                        <%
                    }
                }
            }

            $pk = '$' . $singularVar . '->' . $primaryKey[0];
            %>
            <td class="actions">
                <?= $this->Icon->link(__('View'), ['action' => 'view', <%= $pk %>]) ?>
                <?= $this->Icon->link(__('Edit'), ['action' => 'edit', <%= $pk %>]) ?>
                <?= $this->Icon->postLink(__('Delete'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>