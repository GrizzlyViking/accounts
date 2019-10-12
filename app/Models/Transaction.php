<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Models
 * @property int $id
 * @property int $account_id
 * @property float $value
 * @property float $balance
 * @property string $description
 * @property Carbon $created_at
 */
class Transaction extends Model
{
    protected $fillable = [
        'value',
        'balance',
        'description',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
