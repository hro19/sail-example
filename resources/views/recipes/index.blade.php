<x-app-layout>
    {{-- 成功メッセージの表示 --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <x-wrap.card title="レシピ一覧" content="登録されているレシピ一覧です" />

    <p class="mb-3">
        <a href="{{ route('recipes.create') }}" class="underline text-gray-800 text-2xl">レシピ新規追加 ></a>
    </p>

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
                        <a href="{{ route('recipes.show', $recipe) }}" class="inline-block px-3 py-2 bg-blue-200">詳細</a>
                        {{-- <a href="{{ route('recipes.edit', $recipe) }}" class="inline-block px-3 py-2 bg-green-200">編集</a> --}}
                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="inline-block px-3 py-2 bg-pink-200">
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