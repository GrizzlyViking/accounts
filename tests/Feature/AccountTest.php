<?php

namespace Tests\Unit;

use App\Http\Controllers\AccountController;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function list_accounts()
    {
        $accounts = Account::all()->toArray();
        $this->get(route('account.list'))
            ->assertOk()
            ->assertJson($accounts);
    }


    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function create_an_account()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];

        /** @var Request $request */
        $request = app(Request::class);
        $request->merge($data);

        /** @var AccountController $controller */
        $controller = app(AccountController::class);

        $response = $controller->store($request);
        $account = json_decode($response->getContent(), true);

        $this->post(route('account.create', $data))
            ->assertStatus(200)
            ->assertJson($account);

        User::findOrFail($account['user_id'])->delete();
    }
}
