<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function list_transactions_for_a_specific_account()
    {
        $account = factory(Account::class)->create();
        $transactions = factory(Transaction::class, 10)->create([
            'account_id' => $account->id
        ]);

        $this->get(route('transactions.list', ['account' => $account->id]))
            ->assertOk();

        User::findOrFail($account->user_id)->delete();

        $this->assertTrue(true);
    }

    /** @test */
    public function create_new_transaction_for_specific_account()
    {
        /** @var Account $account */
        $account = factory(Account::class)->create();
        $data = [
            'amount' => $this->faker->randomFloat(2, -1000,1000),
            'description' => $this->faker->text,
        ];

        $this->post(route('transactions.create', ['account' => $account->id]), $data)
        ->assertOk()
        ->assertJson($data);

        User::findOrFail($account->user_id);
    }

    /** @test */
    public function delete_a_specific_transaction()
    {
        $account = factory(Account::class)->create();
        $transaction = factory(Transaction::class)->create(['account_id' => $account->id]);

        $this->delete(route('transactions.delete', ['account' => $account->id, 'transaction' => $transaction->id]))
            ->assertOk();

        $this->assertNull(Transaction::find($transaction->id));
    }
}
