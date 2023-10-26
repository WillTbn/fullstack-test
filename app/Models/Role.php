<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function abilities():HasMany
    {
        return $this->hasMany(Ability::class, 'role_id', 'id');
    }
}
