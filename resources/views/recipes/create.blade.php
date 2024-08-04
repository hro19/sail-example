<x-app-layout>
    <x-wrap.card title="レシピ新規追加" content="レシピを新たに新規登録" />

    <form action="{{ route('recipe.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title"    
id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label fo  
r="category_id">カテゴリー</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">画像</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            レシピを作成
        </button>
    </form>
</x-app-layout>