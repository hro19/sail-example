@props(['recipe'])

<article class="border border-gray-300 p-4">
    <h2 class="text-lg font-bold mb-2">{{ $recipe->title }}</h2> {{-- $title を受け取るように変更 --}}
    <p class="text-gray-600">
        <span class="font-semibold">ID:</span> {{ $recipe->id }}<br> {{-- $id を受け取るように変更 --}}
        <span class="font-semibold">カテゴリー:</span> {{ $recipe->categoryName }}<br> {{-- $categoryName を受け取るように変更 --}}
        <span class="font-semibold">作成者:</span> {{ $recipe->userName }}<br> {{-- $userName を受け取るように変更 --}}
        <span class="font-semibold">閲覧数:</span> {{ $recipe->views }}<br> {{-- $views を受け取るように変更 --}}
        <span class="font-semibold">作成日時:</span> {{ $recipe->createdAt }} {{-- $createdAt を受け取るように変更 --}}
    </p>

    <a href="{{ route('recipes.show', $recipe->id) }}" class="inline-block px-3 py-2 bg-blue-200 mt-2">詳細</a> {{-- $id を使ってルートを生成 --}}
</article>