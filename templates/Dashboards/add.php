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
            <?= $this->Html->link(__('List Dashboards'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="dashboards form content">
            <?= $this->Form->create($dashboard) ?>
            <fieldset>
                <legend><?= __('Add Dashboard') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
