<?php

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class AccountAndTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Account::class, 50)->create()->each(function(Account $account) {
            $account->transactions()->saveMany(factory(Transaction::class, 50)->make());
        });
    }
}
