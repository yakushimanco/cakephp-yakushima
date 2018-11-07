<?php

namespace Yakushima\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Validation\Validator;
use Stripe\Account;
use Stripe\Customer;

/**
 * Profiles Model
 *
 * @property \Yakushima\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Yakushima\Model\Entity\Profile get($primaryKey, $options = [])
 * @method \Yakushima\Model\Entity\Profile newEntity($data = null, array $options = [])
 * @method \Yakushima\Model\Entity\Profile[] newEntities(array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Profile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\Profile|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\Profile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Profile[] patchEntities($entities, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Profile findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProfilesTable extends Table
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

        $this->setTable('profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Yakushima.Users'
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->integer('appraisal_years')
            ->requirePresence('appraisal_years', 'create')
            ->notEmpty('appraisal_years');

        $validator
            ->scalar('catch_copy')
            ->requirePresence('catch_copy', 'create')
            ->notEmpty('catch_copy');

        $validator
            ->scalar('profile')
            ->requirePresence('profile', 'create')
            ->notEmpty('profile');

        $validator
            ->integer('price_per_minutes')
            ->requirePresence('price_per_minutes', 'create')
            ->notEmpty('price_per_minutes');

        $validator
            ->integer('point')
            ->requirePresence('point', 'create')
            ->notEmpty('point');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (!$entity->has('stripe_account')) {
            $user = TableRegistry::getTableLocator()->get('Yakushima.Users')->get($entity->get('user_id'));
            $account = Account::create([
                'country' => 'JP',
                'email' => $user->get('email'),
                'type' => 'custom',
            ]);
            $request = Router::getRequest(true);
            $request->trustProxy = true;
            $account->tos_acceptance->date = time();
            $account->tos_acceptance->ip = $request->clientIp();
            $account->save();
            $entity->set('stripe_account', $account->id);
        }

        if (!$entity->has('stripe_customer')) {
            $customer = Customer::create();
            $entity->set('stripe_customer', $customer->id);
        }
    }
}
