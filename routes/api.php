<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| List accounts (also returns the sum balance of the account, based on the sum of the amount of all transactions for the account)
| Create new account
| List transactions for specific account
| Create new transaction for specific account
| Delete a specific transaction
|
*/

Route::prefix('account')->middleware('api')->group(function () {
    Route::get('/', ['uses' => 'AccountController@index', 'as' => 'account.list']);
    Route::post('/', ['uses' => 'AccountController@store', 'as' => 'account.create']);

    Route::prefix('{account_id}/transactions')->group(function () {
        Route::get('/', ['uses' => 'TransactionController@index', 'as' => 'transactions.list']);
        Route::post('/', ['uses' => 'TransactionController@store', 'as' => 'transactions.create']);
        Route::delete('{transaction_id}', ['uses' => 'TransactionController@destroy', 'as' => 'transactions.delete']);
    });
});
