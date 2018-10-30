<?php
namespace Yakushima\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rooms Model
 *
 * @property \Yakushima\Model\Table\ReservationsTable|\Cake\ORM\Association\BelongsTo $Reservations
 *
 * @method \Yakushima\Model\Entity\Room get($primaryKey, $options = [])
 * @method \Yakushima\Model\Entity\Room newEntity($data = null, array $options = [])
 * @method \Yakushima\Model\Entity\Room[] newEntities(array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Room|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\Room|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\Room patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Room[] patchEntities($entities, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\Room findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RoomsTable extends Table
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

        $this->setTable('rooms');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Reservations', [
            'foreignKey' => 'reservation_id',
            'joinType' => 'INNER',
            'className' => 'Yakushima.Reservations'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->dateTime('start')
            ->allowEmpty('start');

        $validator
            ->dateTime('end')
            ->allowEmpty('end');

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
        $rules->add($rules->existsIn(['reservation_id'], 'Reservations'));
        $rules->add($rules->isUnique(['name'], 'Reservations'));

        return $rules;
    }
}
