<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMutations extends Model
{
    use HasFactory;
    protected $fillable = [
        'mutation_id',
        'item_id',
        'qty',
    ];
    public function mutation(): BelongsTo
    {
        return $this->belongsTo(mutations::class);
    }
    public function item(): BelongsTo
    {
        return $this->belongsTo(items::class);
    }
}
