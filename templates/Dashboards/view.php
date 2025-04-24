<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dashboard $dashboard
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Dashboard'), ['action' => 'edit', $dashboard->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dashboard'), ['action' => 'delete', $dashboard->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboard->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dashboards'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dashboard'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="dashboards view content">
            <h3><?= h($dashboard->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($dashboard->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($dashboard->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
