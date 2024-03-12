<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $characteristics
 */
class RefHeroesFactions extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ref_heroes_factions';

    public function characteristics(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RefHeroesFactionCharacteristics::class, 'heroes_id', 'id');
    }
}
