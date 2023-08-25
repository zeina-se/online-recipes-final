<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'instructions' => 'required',
            'cuisine_id' => 'required|exists:cuisines,id'
           
        ]);
        $data['user_id'] =  Auth::user();

        $recipe = Recipe::createRecipe($data);

        return response()->json([
            'message' => 'Recipe created successfully',
            'recipe' => $recipe
        ]);
    }

    public function getAllRecipes()
    {
        $recipes = Recipe::with(['ingredients', 'cuisine', 'likes', 'comments', 'images'])->withCount(['likes', 'comments'])->get();
        foreach($recipes as $recipe){
            $recipe->is_liked = $recipe->likes->contains('user_id', Auth::id());
        }
        return response()->json([
            'message' => 'success',
            'recipe_data' => $recipes
        ]);
    }

    public function searchRecipe(Request $request)
    {
        $query = $request->input('query');
    
        $recipes = Recipe::where('name', 'like', "%$query%")
            ->orWhereHas('cuisine', function ($cuisineQuery) use ($query) {
                $cuisineQuery->where('name', 'like', "%$query%");
            })
            ->orWhereHas('ingredients', function ($ingredientQuery) use ($query) {
                $ingredientQuery->where('name', 'like', "%$query%");
            })
            ->get();
    
        return response()->json([
            'recipes' => $recipes,
        ]);
    }

    
    }