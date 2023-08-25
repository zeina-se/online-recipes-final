<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')->withPivot('quantity','units');
    }
    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class);
    }
    public static function createRecipe($data)
    {
        $recipe = new Recipe();
    
        $recipe->name = $data['name'];
        $recipe->user_id = $data['user_id'];
        $recipe->cuisine_id = $data['cuisine_id'];
    
        $recipe->save();
    
        $recipe->ingredients()->attach($data['ingredients']);
    
        return $recipe;
    }
}
