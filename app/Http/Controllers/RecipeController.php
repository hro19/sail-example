<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class RecipeController extends Controller
{
    public function home()
    {
        //最新数件
        $recipes = Recipe::query()->orderBy('created_at', 'desc')->limit(6)->get();

        //人気レシピ数件
        $populars = Recipe::orderBy('views', 'desc')->limit(4)->get();
        return view('home', compact('recipes','populars'));
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        // dd($filters);

        $query = Recipe::select('recipes.*', \DB::raw('AVG(reviews.rating) as rating'))
        ->join('users', 'users.id', '=', 'recipes.user_id')
        ->leftJoin('reviews', 'reviews.recipe_id', '=', 'recipes.id')
        ->groupBy('recipes.id')
        ->orderBy('recipes.created_at', 'desc');

        if( !empty($filters) ) {
            // もしカテゴリーが選択されていたら
            if( !empty($filters['categories']) ) {
                // カテゴリーで絞り込み選択したカテゴリーIDが含まれているレシピを取得
                $query->whereIn('recipes.category_id', $filters['categories']);
            }
            // もし評価値のラジオボタンが押されていたら
            if( !empty($filters['rating']) ) {
                // 評価値で絞り込み選択した評価値が含まれているレシピを取得
                $query->having('rating', '>=', $filters['rating'])
                ->orderBy('rating', 'desc');
            }
            // もしタイトルが入っていたら
            if( !empty($filters['title']) ) {
                // タイトルで絞り込みタイトルが含まれているレシピを取得
                $query->where('recipes.title', 'like', '%'.$filters['title'].'%');
            }
        }
    $recipes = $query->get();
    // dd($recipes);
    $categories = Category::all();

    return view('recipes.index', compact('recipes', 'categories', 'filters'));
}

    public function create()
    {
        $categories = Category::all(); // カテゴリー一覧を取得

        return view('recipes.create', compact('categories')); // createビューにカテゴリー一覧を渡す
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'required|string|max:100',
        ]);

        DB::transaction(function () use ($request, $validatedData) {
            $recipe = new Recipe();
            $recipe->id = Uuid::uuid4()->toString();
            $recipe->user_id = auth()->id();
            $recipe->title = $validatedData['title'];
            $recipe->description = $validatedData['description'];
            $recipe->category_id = $validatedData['category_id'];

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('recipe_images', 'public');
                $recipe->image = $imagePath;
            }

            $recipe->save();
            // dd($recipe->id);

            // UUIDが正しく設定されていることを確認
            \Log::info('Recipe ID after save: ' . $recipe->id);

            foreach ($validatedData['ingredients'] as $ingredientData) {
                $ingredient = new Ingredient($ingredientData);
                $recipe->ingredients()->save($ingredient);
            }
        });

        return redirect()->route('recipe.index')->with('success', 'レシピが正常に作成されました。');
    }
    

    public function show(Recipe $recipe)
    {
         // レシピの閲覧数を1増やす
        $recipe->increment('views');

        $rating = $recipe->reviews()->avg('rating');
        $recipe = Recipe::with(['category', 'ingredients', 
        'steps' => function($query) {
            $query->orderBy('step_number', 'asc');
        }, 
        'reviews'])
    ->find($recipe->id);
        // dd($recipe);
        return view('recipes.show', compact('recipe', 'rating')); // showビューにレシピデータと評価値を渡す
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe')); // editビューにレシピデータを渡す
    }

    public function update(Request $request, Recipe $recipe)
    {
        // バリデーション
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            // 他の必要なバリデーションルールを追加
        ]);

        // レシピの更新
        $recipe->update($validatedData);

        return redirect()->route('recipes.index')->with('success', 'レシピが更新されました');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete(); // レシピを削除

        return redirect()->route('recipes.index')->with('success', 'レシピが削除されました');
    }
}