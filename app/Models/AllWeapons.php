<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllWeapons extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'all_weapons';

    public function weaponType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RefTypesWeapons::class, 'id', 'type_weapon_id');
    }

    public function unique(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RefUniqueWeapons::class, 'id', 'unique_id');
    }
}
