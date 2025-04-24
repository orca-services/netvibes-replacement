<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dashboards Model
 *
 * @property \CakeDC\Users\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Dashboard newEmptyEntity()
 * @method \App\Model\Entity\Dashboard newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Dashboard> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dashboard get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Dashboard findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Dashboard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Dashboard> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dashboard|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Dashboard saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Dashboard>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Dashboard>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Dashboard>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Dashboard> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Dashboard>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Dashboard>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Dashboard>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Dashboard> deleteManyOrFail(iterable $entities, array $options = [])
 */
class DashboardsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('dashboards');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER',
            'className' => 'CakeDC/Users.Users',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('users_id')
            ->notEmptyString('users_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->notEmptyString('name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['users_id'], 'Users'), ['errorField' => 'users_id']);

        return $rules;
    }
}
