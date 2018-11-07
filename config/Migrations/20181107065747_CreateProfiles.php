<?php
use Migrations\AbstractMigration;

class CreateProfiles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('profiles', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('gender', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('appraisal_years', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('catch_copy', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('profile', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('price_per_minutes', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('point', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('stripe_account', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('stripe_customer', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'));
        $table->create();

        $table = $this->table('users');
        $table->removeColumn('gender');
        $table->removeColumn('appraisal_years');
        $table->removeColumn('catch_copy');
        $table->removeColumn('profile');
        $table->removeColumn('price_per_minutes');
        $table->removeColumn('point');
        $table->removeColumn('stripe_account');
        $table->removeColumn('stripe_customer');
        $table->update();
    }
}
