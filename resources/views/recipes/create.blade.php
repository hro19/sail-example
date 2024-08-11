<x-app-layout>
    <x-wrap.card title="レシピ新規追加" content="レシピを新たに新規登録" />

    <div class="container">
        <h1 class="text-2xl font-bold mb-4">新しいレシピを作成</h1>
        <form action="{{ route('recipe.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" class="form-input mt-1 block w-full" id="title" name="title" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">説明</label>
                <textarea class="form-textarea mt-1 block w-full" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">カテゴリー</label>
                <select class="form-select mt-1 block w-full" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">画像</label>
                <input type="file" class="form-input mt-1 block w-full" id="image" name="image">
            </div>
            <div id="ingredients" class="mb-4">
                <h3 class="text-lg font-bold mb-2">材料</h3>
                <div class="ingredient-item flex">
                    <input type="text" name="ingredients[0][name]" placeholder="材料名" required class="form-input mt-1 block w-full">
                    <input type="text" name="ingredients[0][quantity]" placeholder="量" required class="form-input mt-1 block w-full">
                </div>
            </div>
            <button type="button" id="add-ingredient" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">材料を追加</button>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">レシピを作成</button>
        </form>
    </div>
    
    <script>
    let ingredientCount = 1;
    document.getElementById('add-ingredient').addEventListener('click', function() {
        const ingredientsDiv = document.getElementById('ingredients');
        const newIngredient = document.createElement('div');
        newIngredient.className = 'ingredient-item';
        newIngredient.innerHTML = `
        <div class="ingredient-item flex">
            <input type="text" name="ingredients[${ingredientCount}][name]" placeholder="材料名" required class="form-input mt-1 block w-full">
            <input type="text" name="ingredients[${ingredientCount}][quantity]" placeholder="量" required class="form-input mt-1 block w-full">
        </div>
        `;
        ingredientsDiv.appendChild(newIngredient);
        ingredientCount++;
    });
    </script>
</x-app-layout>