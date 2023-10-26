<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'zip_code', 'street', 'city', 'number', 'user_id'
    ];
}
