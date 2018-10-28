<?php
use Cake\Core\Configure;
use Stripe\Stripe;

Stripe::setApiKey(Configure::read('Stripe.secretApiKey'));
