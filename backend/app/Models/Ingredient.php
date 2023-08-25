<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function createIngredient($data)
    {
        $ingredient = new Ingredient();
        $ingredient->name = $data['name'];
        $ingredient->save();

        return $ingredient;
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')->withPivot('quantity','units');
    }
}
