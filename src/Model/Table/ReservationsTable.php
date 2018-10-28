<?php
namespace Yakushima\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Reservations Model
 *
 * @property \Yakushima\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \Yakushima\Model\Table\SchedulesTable|\Cake\ORM\Association\BelongsTo $Schedules
 * @property \Yakushima\Model\Table\RoomsTable|\Cake\ORM\Association\HasMany $Rooms
 *
 * @method \Yakushima\Model\Entity\Reservation get($primaryKey, $options = [])
 * @method \Yakushima\Model\Entity\Reservation newEntity($data = null, array $options = [])
 * @method \Yakushima\Model\Entity\Reservation[] newEntities(array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Reservation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\Reservation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\Reservation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Reservation[] patchEntities($entities, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Reservation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReservationsTable extends Table
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

        $this->setTable('reservations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Yakushima.Users'
        ]);
        $this->belongsTo('Schedules', [
            'foreignKey' => 'schedule_id',
            'joinType' => 'INNER',
            'className' => 'Yakushima.Schedules'
        ]);
        $this->hasMany('Rooms', [
            'foreignKey' => 'reservation_id',
            'className' => 'Yakushima.Rooms'
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
        $rules->add($rules->existsIn(['schedule_id'], 'Schedules'));

        return $rules;
    }

    public function afterSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        $table = TableRegistry::getTableLocator()->get('Rooms');
        $room = $table->newEntity([
            'reservation_id' => $entity->get('id'),
            'name' => uniqid(),
            'start' => null,
            'end' => null,
        ]);
        $table->save($room);
    }
}
