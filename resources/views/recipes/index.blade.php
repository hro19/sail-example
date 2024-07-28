<x-app-layout>
    {{-- 成功メッセージの表示 --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <x-wrap.card title="レシピ一覧" content="登録されているレシピ一覧です" />


    <p class="mb-3">
        <a href="{{ route('recipe.create') }}" class="underline text-gray-800 text-2xl">レシピ新規追加 ></a>
    </p>

    <div class="border-2 border-fuchsia-800 p-4 m-4">
        <div class="col-span-1 bg-white p-4 h-max sticky top-4">
            <form action="{{route('recipe.index')}}" method="GET">
              <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-700 mr-2">
                  <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-xl text-gray-800 font-bold mb-4">レシピ検索</h3>
              </div>
              <div class="mb-4 p-6 border border-gray-300">
                <label class="text-lg text-gray-800">評価</label>
                <div class="ml-4 mb-2">
                  <input type="radio" name="rating" value="0" id="rating0"
                    {{ ($filters['rating'] ?? null) == null ? 'checked' : ''}}/>
                    <!-- もしratingのフィルターがあったら、空文字を返す、そうでなければ ’checked'を返す -->
                  <label for="rating0">指定しない</label>
                </div>
                <div class="ml-4 mb-2">
                  <input type="radio" name="rating" value="3" id="rating3"
                  {{ ($filters['rating'] ?? null) == "3" ? 'checked' : ''}}/>
                  <label for="rating3">3以上</label>
                </div>
                <div class="ml-4 mb-2">
                  <input type="radio" name="rating" value="4" id="rating4"
                  {{ ($filters['rating'] ?? null) == "4" ? 'checked' : ''}}/>
                  <label for="rating4">4以上</label>
                </div>
              </div> 
              {{-- <div class="mb-4 p-6 border border-gray-300">
                <label class="text-lg text-gray-800">カテゴリー</label>
            @foreach($categories as $category)
                <div class="ml-4 mb-2">
                  <input type="checkbox" name="categories[]" value="{{$category['id']}}" id="category{{$category['id']}}" {{ (in_array($category['id'], $filters['categories'] ?? []))  ? 'checked' : '' }}/>
                  <label for="category{{$category['id']}}">{{$category['name']}}</label>
                </div>
            @endforeach
              </div>  --}}
              {{-- <input type="text" name="title" value="{{ $filters['title'] ?? '' }}" placeholder="レシピ名を入力" class="border border-gray-300 p-2 mb-4 w-full">
              <div class="text-center">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">検索</button>
              </div> --}}
            </form>
          </div>
    </div>

    <table class="border border-gray-800">
        <thead class="border border-gray-800">
            <tr>
                <th>ID</th>
                <th>タイトル</th>
                <th>カテゴリー</th>
                <th>作成者</th>
                <th>閲覧数</th>
                <th>作成日時</th>
                <th>アクション</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipes as $recipe)
                <tr class="border-t border-gray-300">
                    <td>{{ $recipe->id }}</td>
                    <td>{{ $recipe->title }}</td>
                    <td>{{ $recipe->category->name }}</td> {{-- カテゴリー名を表示 --}}
                    <td>{{ $recipe->user->name }}</td>   {{-- 作成者名を表示 --}}
                    <td>{{ $recipe->views }}</td>
                    <td>{{ $recipe->created_at }}</td>
                    <td>
                        <a href="{{ route('recipe.show', $recipe) }}" class="inline-block px-3 py-2 bg-blue-200">詳細</a>
                        {{-- <a href="{{ route('recipes.edit', $recipe) }}" class="inline-block px-3 py-2 bg-green-200">編集</a> --}}
                        <form action="{{ route('recipe.destroy', $recipe) }}" method="POST" class="inline-block px-3 py-2 bg-pink-200">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>