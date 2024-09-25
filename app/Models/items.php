<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'item_code',
        'category_id',
        'location_id',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function location()
    {
        return $this->belongsTo(Locations::class);
    }
}
