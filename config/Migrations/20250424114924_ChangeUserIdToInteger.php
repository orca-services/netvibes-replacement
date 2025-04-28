<?php
declare(strict_types=1);

use Cake\Datasource\ConnectionManager;
use Migrations\BaseMigration;

/**
 * Change User Id To Integer
 */
class ChangeUserIdToInteger extends BaseMigration
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
        $this->table('failed_password_attempts')
            ->dropForeignKey([], 'failed_password_attempts_ibfk_1')
            ->removeIndexByName('user_id')
            ->update();

        $this->table('failed_password_attempts')->truncate();
        $this->table('users')->truncate();

        $this->table('failed_password_attempts')
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->changeColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->update();

        $this->table('users')
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
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
        $this->table('failed_password_attempts')
            ->dropForeignKey(
                'user_id',
            )->save();

        $this->table('failed_password_attempts')
            ->removeIndexByName('FK_user_id_idx')
            ->update();

        $this->table('failed_password_attempts')
            ->changeColumn('id', 'uuid', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->changeColumn('user_id', 'uuid', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->addIndex(
                $this->index('user_id')
                    ->setName('user_id'),
            )
            ->update();

        $this->table('users')
            ->changeColumn('id', 'uuid', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('failed_password_attempts')
            ->addForeignKey(
                $this->foreignKey('user_id')
                    ->setReferencedTable('users')
                    ->setReferencedColumns('id')
                    ->setOnDelete('CASCADE')
                    ->setOnUpdate('CASCADE')
                    ->setName('failed_password_attempts_ibfk_1'),
            )
            ->update();
    }
}
