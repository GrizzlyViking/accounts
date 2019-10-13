<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TransactionController extends Controller
{
    /**
     * @param Account $account
     *
     * @return JsonResponse
     */
    public function index(Account $account)
    {
        return response()->json($account->transactions);
    }

    /**
     * @param Account $account
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Account $account, Request $request)
    {
        $validated = $request->validate([
            'amount'       => 'required|numeric',
            'description' => 'required',
        ]);

        Arr::set($validated, 'account_id', $account->id);

        $transaction = Transaction::create($validated);

        return response()->json($transaction->toArray(), 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param Account     $account
     * @param Transaction $transaction
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Account $account, Transaction $transaction)
    {
        if ($transaction->account_id !== $account->id) {
            throw new Exception('Transaction: '.$transaction->id.' does not belong to Account: '.$account->id);
        }
        $transaction->delete();

        return response()->json('OK');
    }
}
