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
        factory(Account::class, 100)->create()->each(function(Account $account) {
            factory(Transaction::class, rand(50, 300))->create([
                'account_id' => $account->id
            ]);

            Transaction::where('account_id', $account->id)->orderBy('created_at')->each();
        });
    }
}
