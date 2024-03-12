<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefHeroesFactionCharacteristics extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ref_heroes_faction_characteristics';

    public function characteristicName(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RefCharacteristics::class, 'id', 'characteristic_id');
    }
}
