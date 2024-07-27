<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all(); // 全レシピを取得
        return view('recipes.index', compact('recipes')); // indexビューにレシピデータを渡す
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