<?php
use Migrations\AbstractMigration;

class AddUseVideoToProfiles extends AbstractMigration
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
        $table = $this->table('profiles');
        $table->addColumn('use_video', 'boolean', [
            'after' => 'point',
            'default' => true,
            'null' => false,
        ]);
        $table->update();
    }
}
