<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mutations extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'mutation_type_id',
        'user_id',
    ];
    public function mutationType(): BelongsTo
    {
        return $this->belongsTo(MutationTypes::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
