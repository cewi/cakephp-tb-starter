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

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
        ->map(function($field) use ($immediateAssociations) {
            foreach ($immediateAssociations as $alias => $details) {
                if ($field === $details['foreignKey']) {
                    return [$field => $details];
                }
            }
        })
        ->filter()
        ->reduce(function($fields, $value) {
    return $fields + $value;
}, []);

$groupedFields = collection($fields)
        ->filter(function($field) use ($schema) {
            return $schema->columnType($field) !== 'binary';
        })
        ->groupBy(function($field) use ($schema, $associationFields) {
            $type = $schema->columnType($field);
            if (isset($associationFields[$field])) {
                return 'string';
            }
            if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
                return 'number';
            }
            if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
                return 'date';
            }
            return in_array($type, ['text', 'boolean']) ? $type : 'string';
        })
        ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List {0}', [__('<%= $pluralHumanName %>')]), ['action' => 'index'], ['icon' => 'glyphicon-list']) ?> </li>
    <li><?= $this->Html->link(__('Edit {0}', [__('<%= $singularHumanName %>')]), ['action' => 'edit', <%= $pk %>], ['icon'=>'glyphicon-pencil']) ?> </li>
    <li><?= $this->Form->postLink(__('Delete {0}', [__('<%= $singularHumanName %>')]), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>), 'icon'=>'glyphicon-warning-sign']) ?> </li>
</ul>
<?php $this->end(); ?>

<h2><?= h(__($<%= $singularVar %>-><%= $displayField %>)) ?></h2>
<div class="row">
    <% if ($groupedFields['string']) : %>
    <div class="col-lg-5">
            <% foreach ($groupedFields['string'] as $field) : %>
                <%
                if (isset($associationFields[$field])) :
                    $details = $associationFields[$field];
                    %>
        <h6><?= __('<%= Inflector::humanize($details['property']) %>') ?></h6>
                    <p><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></p>
                <% else : %>
        <h6><?= __('<%= Inflector::humanize($field) %>') ?></h6>
                    <p><?= h($<%= $singularVar %>-><%= $field %>) ?></p>
                <% endif; %>
            <% endforeach; %>
    </div>
    <% endif; %>
    <% if ($groupedFields['number']) : %>
    <div class="col-lg-2">
            <% foreach ($groupedFields['number'] as $field) : %>
        <h6><?= __('<%= Inflector::humanize($field) %>') ?></h6>
                <p><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></p>
            <% endforeach; %>
    </div>
    <% endif; %>
    <% if ($groupedFields['date']) : %>
    <div class="col-lg-2">
            <% foreach ($groupedFields['date'] as $field) : %>
        <h6><%= "<%= __('" . Inflector::humanize($field) . "') %>" %></h6>
                <p><?= h($<%= $singularVar %>-><%= $field %>) ?></p>
            <% endforeach; %>
    </div>
    <% endif; %>
    <% if ($groupedFields['boolean']) : %>
    <div class="col-lg-2">
            <% foreach ($groupedFields['boolean'] as $field) : %>
        <h6><?= __('<%= Inflector::humanize($field) %>') ?></h6>
                <p><?= $<%= $singularVar %>-><%= $field %> ? __('Yes') : __('No'); ?></p>
            <% endforeach; %>
    </div>
    <% endif; %>
</div>
<% if ($groupedFields['text']) : %>
    <% foreach ($groupedFields['text'] as $field) : %>
<div class="row texts">
            <div class="col-lg-9">
                <h6><?= __('<%= Inflector::humanize($field) %>') ?></h6>
                <?= $this->Text->autoParagraph(h($<%= $singularVar %>-><%= $field %>)); ?>
            </div>
        </div>
    <% endforeach; %>
<% endif; %>
<%
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    %>
<div class="related row">
        <div class = "col-lg-12">
            <h4><?= __('Related {0}', [__('<%= $otherPluralHumanName %>')]) ?></h4>
            <?php if (!empty($<%= $singularVar %>-><%= $details['property'] %>)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <% foreach ($details['fields'] as $field): %>
                    <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
                        <% endforeach; %>
                    <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($<%= $singularVar %>-><%= $details['property'] %> as $<%= $otherSingularVar %>): ?>
                    <tr>
                        <% foreach ($details['fields'] as $field): %>
                    <td><?= h($<%= $otherSingularVar %>-><%= $field %>) ?></td>
                        <% endforeach; %>
                        <% $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; %>
                    <td class="actions">
                            <div class="btn-group btn-group-xs" role="group" aria-label="Actions">
                                <?= $this->Html->link(__('View'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', <%= $otherPk %>], ['icon'=>'glyphicon-zoom-in', 'class'=>'btn btn-default', 'role'=>'button', 'short'=>true]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => '<%= $details['controller'] %>', 'action' => 'edit', <%= $otherPk %>], ['icon' => 'glyphicon-pencil', 'class'=>'btn btn-default', 'role'=>'button', 'short'=>true]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => '<%= $details['controller'] %>', 'action' => 'delete', <%= $otherPk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $otherPk %>), 'icon'=>'glyphicon-warning-sign', 'class'=>'btn btn-danger', 'role'=>'button', 'short'=>true]) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<% endforeach; %>
