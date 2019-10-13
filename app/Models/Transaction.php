<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @package App\Models
 * @property int $id
 * @property int $account_id
 * @property float $amount
 * @property string $description
 * @property Carbon $created_at
 */
class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'description',
        'account_id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
