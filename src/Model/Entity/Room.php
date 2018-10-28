<?php
namespace Yakushima\Model\Entity;

use Cake\ORM\Entity;

/**
 * Room Entity
 *
 * @property string $id
 * @property string $reservation_id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $start
 * @property \Cake\I18n\FrozenTime $end
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Yakushima\Model\Entity\Reservation $reservation
 */
class Room extends Entity
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
        'reservation_id' => true,
        'name' => true,
        'start' => true,
        'end' => true,
        'created' => true,
        'modified' => true,
        'reservation' => true
    ];
}
