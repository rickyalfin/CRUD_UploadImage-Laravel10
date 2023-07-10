<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;

    protected $table = "hewan";
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
