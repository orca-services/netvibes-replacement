<?php
/**
 * Dashboard Index template
 *
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Dashboard> $dashboards
 */
?>
<div class="dashboards index content">
    <?= $this->Html->link(__('New Dashboard'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Dashboards') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dashboards as $dashboard): ?>
                <tr>
                    <td><?= $this->Number->format($dashboard->id) ?></td>
                    <td><?= h($dashboard->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $dashboard->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dashboard->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $dashboard->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $dashboard->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
