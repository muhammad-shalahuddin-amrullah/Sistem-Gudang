<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'role_name',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
