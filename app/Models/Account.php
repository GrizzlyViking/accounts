<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Account
 *
 * @package App\Models
 * @property int                      $id
 * @property int                      $user_id
 * @property string                   $name
 * @property User                     $user
 * @property Transaction[]|Collection $transactions
 * @property float                    $balance
 */
class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getBalanceAttribute()
    {
        return $this->transactions()->sum('amount');
    }
}
