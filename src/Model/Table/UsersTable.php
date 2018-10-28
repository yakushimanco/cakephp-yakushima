<?php

namespace Yakushima\Model\Table;

use Cake\Validation\Validator;
use CakeDC\Users\Model\Table\UsersTable as BaseUsersTable;

/**
 * Users Model
 *
 * @property \Yakushima\Model\Table\ReservationsTable|\Cake\ORM\Association\HasMany $Reservations
 * @property \Yakushima\Model\Table\SchedulesTable|\Cake\ORM\Association\HasMany $Schedules
 * @property \Yakushima\Model\Table\SocialAccountsTable|\Cake\ORM\Association\HasMany $SocialAccounts
 *
 * @method \Yakushima\Model\Entity\User get($primaryKey, $options = [])
 * @method \Yakushima\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \Yakushima\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \Yakushima\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends BaseUsersTable
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->hasMany('Reservations', [
            'foreignKey' => 'user_id',
            'className' => 'Yakushima.Reservations'
        ]);
        $this->hasMany('Schedules', [
            'foreignKey' => 'user_id',
            'className' => 'Yakushima.Schedules'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('gender')
            ->maxLength('gender', 10)
            ->allowEmpty('gender');

        $validator
            ->integer('appraisal_years')
            ->allowEmpty('appraisal_years');

        $validator
            ->scalar('catch_copy')
            ->allowEmpty('catch_copy');

        $validator
            ->scalar('profile')
            ->allowEmpty('profile');

        $validator
            ->integer('price_per_minutes')
            ->allowEmpty('price_per_minutes');

        $validator
            ->scalar('stripe_account')
            ->maxLength('stripe_account', 255)
            ->requirePresence('stripe_account', 'create')
            ->notEmpty('stripe_account');

        $validator
            ->scalar('stripe_customer')
            ->maxLength('stripe_customer', 255)
            ->requirePresence('stripe_customer', 'create')
            ->notEmpty('stripe_customer');

        return $validator;
    }
}
