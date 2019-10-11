<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Models
 * @property int                      $id
 * @property int                      $user_id
 * @property string                   $name
 * @property User                     $user
 * @property Transaction[]|Collection $transactions
 */
class Account extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
