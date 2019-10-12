<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;

class RecalculateBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:recalculate-balance {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'works its way through transactions, looks at the value, and adjusts the balance again.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('user')) {
            $users = User::where('id', $this->argument('user'))->get();
        } else {
            $users = User::all();
        }
        $users->each(function (User $user) {
            $user->accounts->each(function (Account $account) {
                $balance = 0;
                $account->transactions->sortBy('created_at')->each(function (Transaction $transaction) use (&$balance) {
                    $balance += $transaction->value;
                    $transaction->update(['balance', $balance]);
                });
                $this->info('Account: '. $account->name . ' for user ' . $account->user->email . ' as been recalculated.');
            });
        });


    }
}
