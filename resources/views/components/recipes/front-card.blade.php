@props(['recipe'])

<article class="border border-gray-300 p-4">
    <h2 class="text-lg font-bold mb-2">{{ $recipe->title }}</h2>
    <p class="text-gray-600">
        <span class="font-semibold">ID:</span> {{ $recipe->id }}<br>
        <span class="font-semibold">カテゴリー:</span> {{ $recipe->category->name }}<br>
        <span class="font-semibold">作成者:</span> {{ $recipe->user->name }}<br>
        <span class="font-semibold">閲覧数:</span> {{ $recipe->views }}<br>
        <span class="font-semibold">作成日時:</span> {{ $recipe->created_at->format("Y年m月d日") }}
    </p>

    <a href="{{ route('recipes.show', $recipe) }}" class="inline-block px-3 py-2 bg-blue-200 mt-2">詳細</a> 
</article>