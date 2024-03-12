<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeapons extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_weapons';

    public function weaponType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RefTypesWeapons::class, 'id', 'type_weapon_id');
    }

    public function weapon(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AllWeapons::class, 'id', 'weapon_id');
    }
}
