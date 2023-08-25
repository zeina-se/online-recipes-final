<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_id',
        'user_id',
    ];
    public $timestamps = false;
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
