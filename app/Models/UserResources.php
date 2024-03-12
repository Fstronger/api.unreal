<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResources extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_resources';

    public function resourcesName(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RefResources::class, 'id', 'resource_id');
    }
}
