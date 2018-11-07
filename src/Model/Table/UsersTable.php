<?php

namespace Yakushima\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Validation\Validator;
use CakeDC\Users\Model\Table\UsersTable as BaseUsersTable;
use Stripe\Account;
use Stripe\Customer;
use Yakushima\Model\Entity\User;

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
    const ROLE_FORTUNE_TELLER = 'fortune-teller';

    const GENDER_FEMALE = 'female';

    const GENDER_MALE = 'male';

    const GENDER_OTHER = 'other';
    
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
        $this->hasOne('Profiles', [
            'foreignKey' => 'user_id',
            'className' => 'Yakushima.Profiles'
        ]);
    }

    /**
     * Returns the query as passed.
     *
     * By default findAll() applies no conditions, you
     * can override this method in subclasses to modify how `find('all')` works.
     *
     * @param \Cake\ORM\Query $query The query to find with
     * @param array $options The options to use for the find
     * @return \Cake\ORM\Query The query builder
     */
    public function findUsers(Query $query, array $options)
    {
        $query
            ->where([
                'Users.role' => self::ROLE_USER,
            ]);

        return $query;
    }

    /**
     * Returns the query as passed.
     *
     * By default findAll() applies no conditions, you
     * can override this method in subclasses to modify how `find('all')` works.
     *
     * @param \Cake\ORM\Query $query The query to find with
     * @param array $options The options to use for the find
     * @return \Cake\ORM\Query The query builder
     */
    public function findFortuneTellers(Query $query, array $options)
    {
        $query
            ->where([
                'Users.role' => self::ROLE_FORTUNE_TELLER,
            ]);

        return $query;
    }

    public function afterSave(Event $event, User $entity, ArrayObject $options)
    {
        if ($entity->isNew()) {
            $table = TableRegistry::getTableLocator()->get('Yakushima.Profiles');
            $profile = $table->newEntity();
            $profile->set('user_id', $entity->get('id'));
            $table->saveOrFail($profile);
        }
    }
}
