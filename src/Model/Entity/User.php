<?php

namespace Yakushima\Model\Entity;

use CakeDC\Users\Model\Entity\User as BaseUser;

/**
 * User Entity
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $token
 * @property \Cake\I18n\FrozenTime $token_expires
 * @property string $api_token
 * @property \Cake\I18n\FrozenTime $activation_date
 * @property string $secret
 * @property bool $secret_verified
 * @property \Cake\I18n\FrozenTime $tos_date
 * @property bool $active
 * @property bool $is_superuser
 * @property string $role
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Yakushima\Model\Entity\Reservation[] $reservations
 * @property \Yakushima\Model\Entity\Schedule[] $schedules
 * @property \Yakushima\Model\Entity\SocialAccount[] $social_accounts
 */
class User extends BaseUser
{

}
