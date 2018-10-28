<?php
use Migrations\AbstractMigration;

class AddProfilesToUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('gender', 'string', [
            'after' => 'last_name',
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('appraisal_years', 'integer', [
            'after' => 'gender',
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('catch_copy', 'text', [
            'after' => 'appraisal_years',
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('profile', 'text', [
            'after' => 'catch_copy',
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('price_per_minutes', 'integer', [
            'after' => 'profile',
            'default' => null,
            'limit' => 5,
            'null' => true,
        ]);
        $table->update();
    }
}
