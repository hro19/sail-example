<x-app-layout>
    {{-- 成功メッセージの表示 --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <p class="p-3 bg-lime-400"><a href="{{ route('recipes.home') }}" class="underline">トップページ</a></p>
    <p class="p-3 bg-amber-600"><a href="{{route('recipes.index')}}" class="underline">recipesページ</a></p>

    <div class="mx-3">     
        <h2 class="my-3 py-2 px-3 text-3xl border-4 border-yellow-600">レシピ最新</h2>
        <section class="grid grid-cols-2 gap-4">
            @foreach ($recipes as $recipe)
               <x-recipes.front-card :recipe="$recipe" />
            @endforeach
        </section>
    </div>

    
    <div class="mx-3">     
        <h2 class="my-3 py-2 px-3 text-3xl border-4 border-cyan-500">人気レシピ</h2>
        <section class="grid grid-cols-2 gap-4"> 
            @foreach ($populars as $p)
                <article class="border border-gray-300 p-4">
                    <h2 class="text-lg font-bold mb-2">{{ $p->title }}</h2>
                    <p class="text-gray-600">
                        <span class="font-semibold">ID:</span> {{ $p->id }}<br>
                        <span class="font-semibold">カテゴリー:</span> {{ $p->category->name }}<br>
                        <span class="font-semibold">作成者:</span> {{ $p->user->name }}<br>
                        <span class="font-semibold">閲覧数:</span> {{ $p->views }}<br>
                        <span class="font-semibold">作成日時:</span> {{ $p->created_at }}
                    </p>
        
                    <a href="{{ route('recipes.show', $p) }}" class="inline-block px-3 py-2 bg-cyan-400 mt-2">詳細</a>
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
