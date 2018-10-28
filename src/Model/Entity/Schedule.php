<?php
namespace Yakushima\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property string $id
 * @property string $user_id
 * @property \Cake\I18n\FrozenTime $start
 * @property \Cake\I18n\FrozenTime $end
 * @property int $max
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Yakushima\Model\Entity\User $user
 * @property \Yakushima\Model\Entity\Reservation[] $reservations
 */
class Schedule extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'start' => true,
        'end' => true,
        'max' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'reservations' => true
    ];
}
