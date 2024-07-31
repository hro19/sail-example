<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('recipes.create'); // createビューを表示
    }

    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            // 他の必要なバリデーションルールを追加
        ]);

        // レシピの作成と保存
        Recipe::create($validatedData);

        return redirect()->route('recipes.index')->with('success', 'レシピが作成されました');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe')); // showビューにレシピデータを渡す
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