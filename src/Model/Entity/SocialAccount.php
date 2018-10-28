<?php

namespace Yakushima\Model\Entity;

use CakeDC\Users\Model\Entity\SocialAccount as BaseSocialAccount;

/**
 * SocialAccount Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $provider
 * @property string $username
 * @property string $reference
 * @property string $avatar
 * @property string $description
 * @property string $link
 * @property string $token
 * @property string $token_secret
 * @property \Cake\I18n\FrozenTime $token_expires
 * @property bool $active
 * @property string $data
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Yakushima\Model\Entity\User $user
 */
class SocialAccount extends BaseSocialAccount
{

}
