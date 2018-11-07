<?php
namespace Yakushima\Model\Entity;

use Cake\ORM\Entity;

/**
 * Profile Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $gender
 * @property int $appraisal_years
 * @property string $catch_copy
 * @property string $profile
 * @property int $price_per_minutes
 * @property int $point
 * @property string $stripe_account
 * @property string $stripe_customer
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Yakushima\Model\Entity\User $user
 */
class Profile extends Entity
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
        'gender' => true,
        'appraisal_years' => true,
        'catch_copy' => true,
        'profile' => true,
        'price_per_minutes' => true,
        'point' => true,
        'stripe_account' => true,
        'stripe_customer' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
