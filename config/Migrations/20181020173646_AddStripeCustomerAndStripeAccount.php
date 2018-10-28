<?php
use Migrations\AbstractMigration;

class AddStripeCustomerAndStripeAccount extends AbstractMigration
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
        $this
            ->table('users')
            ->addColumn(
                'stripe_account',
                'string',
                [
                    'after' => 'price_per_minutes',
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ]
            )
            ->addColumn(
                'stripe_customer',
                'string',
                [
                    'after' => 'stripe_account',
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ]
            )
            ->update();
    }
}
