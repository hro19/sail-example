<x-app-layout>
    {{-- 成功メッセージの表示 --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <p class="py-3 bg-lime-300">トップページです</p>
    <p class="py-3 bg-green-300"><a href="{{route('recipes.index')}}" class="underline">recipesページ</a></p>

    <div class="mx-3">     
        <h2 class="my-3 py-2 px-3 text-3xl border-4 border-blue-500">レシピ最新</h2>
        <section class="grid grid-cols-2 gap-4"> 
            @foreach ($recipes as $recipe)
                <article class="border border-gray-300 p-4">
                    <h2 class="text-lg font-bold mb-2">{{ $recipe->title }}</h2>
                    <p class="text-gray-600">
                        <span class="font-semibold">ID:</span> {{ $recipe->id }}<br>
                        <span class="font-semibold">カテゴリー:</span> {{ $recipe->category->name }}<br>
                        <span class="font-semibold">作成者:</span> {{ $recipe->user->name }}<br>
                        <span class="font-semibold">閲覧数:</span> {{ $recipe->views }}<br>
                        <span class="font-semibold">作成日時:</span> {{ $recipe->created_at }}
                    </p>
        
                    <a href="{{ route('recipes.show', $recipe) }}" class="inline-block px-3 py-2 bg-blue-200 mt-2">詳細</a>
                </article>
            @endforeach
        </section>
    </div>


    <div class="relative bg-center bg-gray-200 selection:bg-red-500 py-4">
        <div class="mb-8">
            <x-alpine.data />
        </div>
        <div class="mb-8">
            <x-alpine.open />
        </div>
    </div>

    


</x-app-layout> 
