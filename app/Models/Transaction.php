<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Models
 * @property int $id
 * @property int $account_id
 * @property float $value
 * @property float $balance
 * @property string $description
 */
class Transaction extends Model
{

}
