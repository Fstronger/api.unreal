<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCharacteristics extends Model
{
    use HasFactory;

    // Константа для характеристики "Атака"
    const ATTACK  = 1;

    // Константа для характеристики "Броня"
    const ARMOR = 2;

    // Константа для характеристики "Здоровье"
    const HP = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ref_characteristics';
}
