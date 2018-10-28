<?php

namespace Yakushima\Model\Table;

use CakeDC\Users\Model\Table\SocialAccountsTable as BaseSocialAccountsTable;

/**
 * SocialAccounts Model
 *
 * @property \Yakushima\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Yakushima\Model\Entity\SocialAccount get($primaryKey, $options = [])
 * @method \Yakushima\Model\Entity\SocialAccount newEntity($data = null, array $options = [])
 * @method \Yakushima\Model\Entity\SocialAccount[] newEntities(array $data, array $options = [])
 * @method \Yakushima\Model\Entity\SocialAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\SocialAccount|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Yakushima\Model\Entity\SocialAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\SocialAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \Yakushima\Model\Entity\SocialAccount findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SocialAccountsTable extends BaseSocialAccountsTable
{

}
