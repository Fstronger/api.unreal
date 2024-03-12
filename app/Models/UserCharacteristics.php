<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCharacteristics extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_characteristics';

    public function characteristicName(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RefCharacteristics::class, 'id', 'characteristic_id');
    }
}
