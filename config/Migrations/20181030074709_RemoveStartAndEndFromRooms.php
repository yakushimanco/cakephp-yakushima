<?php
use Migrations\AbstractMigration;

class RemoveStartAndEndFromRooms extends AbstractMigration
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
        $table = $this->table('rooms');
        $table->removeColumn('start');
        $table->removeColumn('end');
        $table->update();
    }
}
