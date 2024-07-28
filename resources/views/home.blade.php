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
        <p class="mb-3"><a href={{route('recipes.index')}} class="underline text-lg">全てのレシピ ></a></p>
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($recipes as $recipe)
               <x-recipes.front-card :recipe="$recipe" />
            @endforeach
        </section>
    </div>

    
    <div class="mx-3">     
        <h2 class="my-3 py-2 px-3 text-3xl border-4 border-cyan-500">人気レシピ</h2>
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($populars as $p)
                <x-recipes.front-card :recipe="$p" />
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
