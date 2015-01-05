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

$fields = collection($fields)
        ->filter(function($field) use ($schema) {
    return $schema->columnType($field) !== 'binary';
});
%>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <% if (strpos($action, 'add') === false): %>
    <li><?= $this->Icon->postLink(__('Delete {0}', ['<%= $singularHumanName %>']), ['action' => 'delete', $<%= $singularVar %>-><%= $primaryKey[0] %>], ['confirm' => __('Are you sure you want to delete # {0}?', $<%= $singularVar %>-><%= $primaryKey[0] %>), 'keepTitle'=>true])?> </li>
    <% endif; %>
    <li><?= $this->Icon->link(__('List {0}', ['<%= $pluralHumanName %>']), ['action' => 'index'], ['keepTitle' => true]) ?></li>
</ul>
<?php $this->end(); ?>
<?= $this->Form->create($<%= $singularVar %>); ?>
<fieldset>
    <legend><?= __('<%= Inflector::humanize($action) %> {0}', ['<%= $singularHumanName %>']) ?></legend>
    <?php
    <%
    foreach ($fields as $field) {
        if (in_array($field, $primaryKey)) {
            continue;
        }
        if (isset($keyFields[$field])) {
            %>
    echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>]);
            <%
            continue;
        }
        if (!in_array($field, ['created', 'modified', 'updated'])) {
            %>
    echo $this->Form->input('<%= $field %>');
            <%
        }
    }
    if (!empty($associations['BelongsToMany'])) {
        foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
            %>
    echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>]);
            <%
        }
    }
    %>
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>