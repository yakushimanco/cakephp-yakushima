<?php
use Migrations\AbstractMigration;

class AddMaxToSchedules extends AbstractMigration
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
        $table = $this->table('schedules');
        $table->addColumn('max', 'integer', [
            'after' => 'end',
            'default' => 10,
            'limit' => 11,
            'null' => true,
        ]);
        $table->update();
    }
}
