<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutationTypes extends Model
{
    use HasFactory;
    protected $fillable = [
        'mutation_type_name',
    ];
    public function mutations()
    {
        return $this->hasMany(mutations::class);
    }
}
