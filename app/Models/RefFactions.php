<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($factionId)
 * @method static where(string $string, int $factionId)
 * @property mixed $heroes
 */
class RefFactions extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ref_factions';

    public function heroes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RefHeroesFactions::class, 'faction_id', 'id');
    }
}
