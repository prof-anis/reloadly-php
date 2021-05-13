<?php

use Busybrain\Reloadly\Api\Account;
use Busybrain\Reloadly\Api\Countries;
use Busybrain\Reloadly\Api\Discount;
use Busybrain\Reloadly\Api\Fxrate;
use Busybrain\Reloadly\Api\Operators;
use Busybrain\Reloadly\Api\Promotions;
use Busybrain\Reloadly\Api\Topup;
use Busybrain\Reloadly\Api\Transactions;

return [
    'countries' => Countries::class,
    'account' => Account::class,
    'transactions' => Transactions::class,
    'operators' => Operators::class,
    'fxrate' => Fxrate::class,
    'promotions' => Promotions::class,
    'topup' => Topup::class,
    'discount' => Discount::class,
];
