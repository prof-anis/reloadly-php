<?php

use Tobexkee\Reloadly\Api\Account;
use Tobexkee\Reloadly\Api\Countries;
use Tobexkee\Reloadly\Api\Discount;
use Tobexkee\Reloadly\Api\Fxrate;
use Tobexkee\Reloadly\Api\Operators;
use Tobexkee\Reloadly\Api\Promotions;
use Tobexkee\Reloadly\Api\Topup;
use Tobexkee\Reloadly\Api\Transactions;

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
