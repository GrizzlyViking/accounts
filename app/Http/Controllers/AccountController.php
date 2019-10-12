<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Account::all(), 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::firstOrCreate(
            ['email'=> $request->get('email')],
            ['password' => Hash::make('changeme')]
        );

        $account = Account::firstOrCreate([
            'name' => $request->get('name'),
            'user_id' => $user->id
        ]);

        return response()->json($account, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
