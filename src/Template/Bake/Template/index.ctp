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
    <li><?= $this->Html->link(__('New {0}', [__('<%= $singularHumanName %>')]), ['action' => 'add'], ['icon' => 'glyphicon-plus']); ?></li>
    <%
    $done = [];
    foreach ($associations as $type => $data):
        foreach ($data as $alias => $details):
            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)):
                %>
    <li><?= $this->Html->link(__('List {0}', [__('<%= Inflector::humanize($details["controller"]) %>')]), ['controller' => '<%= $details["controller"] %>', 'action' => 'index'], ['icon' => 'glyphicon-list']); ?></li>
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
<h2><?= h(__('<%= ucfirst($pluralVar) %>')) ?></h2>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <% foreach ($fields as $field): %>
            <th><?= $this->Paginator->sort('<%= $field %>'); ?></th>
            <% endforeach; %>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
        <tr>
            <?= $this->Form->create(null, ['action' => 'index', 'novalidate' => true]); ?>
            <% foreach ($fields as $field): %>
                <% if ($field != 'id'): %>
            <td><?= $this->Form->input('<%= $field %>', ['div' => false, 'label' => false]); ?></td>
                <% else: %>
            <td>&nbsp;</td>
                <% endif; %>
            <% endforeach; %>
            <td><?= $this->element('Cewi/CakephpTbStarter.searchButtons') ?></td>
            <?= $this->Form->end(); ?>
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
                <div class="btn-group btn-group-xs" role="group" aria-label="Actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', <%= $pk %>], ['icon' => 'glyphicon-zoom-in', 'class'=>'btn btn-default', 'role'=>'button']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', <%= $pk %>], ['icon' => 'glyphicon-pencil', 'class'=>'btn btn-default', 'role'=>'button']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>), 'icon' => 'glyphicon-warning-sign', 'class'=>'btn btn-danger', 'role'=>'button']) ?>
                </div>
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->element('Cewi/CakephpTbStarter.pagination') ?>