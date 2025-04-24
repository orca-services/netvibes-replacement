<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dashboard $dashboard
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dashboard->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dashboard->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Dashboards'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="dashboards form content">
            <?= $this->Form->create($dashboard) ?>
            <fieldset>
                <legend><?= __('Edit Dashboard') ?></legend>
                <?php
                    echo $this->Form->control('users_id', ['options' => $users]);
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
