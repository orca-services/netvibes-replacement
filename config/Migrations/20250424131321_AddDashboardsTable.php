<?php
declare(strict_types=1);

use Migrations\BaseMigration;

/**
 * Add Dashboards Table
 */
class AddDashboardsTable extends BaseMigration
{
    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-up-method
     *
     * @return void
     */
    public function up(): void
    {
        $this->table(
            'failed_password_attempts',
            ['comment' => 'A dashboard has at least one tab.'],
        )
            ->dropForeignKey([], 'FK_user_id')
            ->removeIndexByName('FK_user_id_idx')
            ->update();

        $this->table('dashboards')
            ->addColumn('users_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('name', 'string', [
                'default' => 'No title',
                'limit' => 255,
                'null' => false,
            ])
            ->addIndex(
                $this->index('users_id')
                    ->setName('FK_dashboard_user_id_idx'),
            )
            ->create();

        $this->table('dashboards')
            ->addForeignKey(
                $this->foreignKey('users_id')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('FK_dashboard_user_id'),
            )
            ->update();

        $this->table('failed_password_attempts')
            ->addIndex(
                $this->index('user_id')
                    ->setName('FK_fpa_user_id_idx'),
            )
            ->update();

        $this->table('failed_password_attempts')
            ->addForeignKey(
                $this->foreignKey('user_id')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('FK_fpa_user_id'),
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     *
     * @return void
     */
    public function down(): void
    {
        $this->table('dashboards')
            ->dropForeignKey(
                'users_id',
            )->save();

        $this->table('failed_password_attempts')
            ->dropForeignKey(
                'user_id',
            )->save();

        $this->table('failed_password_attempts')
            ->removeIndexByName('FK_fpa_user_id_idx')
            ->update();

        $this->table('failed_password_attempts')
            ->addIndex(
                $this->index('user_id')
                    ->setName('FK_user_id_idx'),
            )
            ->update();

        $this->table('failed_password_attempts')
            ->addForeignKey(
                $this->foreignKey('user_id')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('FK_user_id'),
            )
            ->update();

        $this->table('dashboards')->drop()->save();
    }
}
