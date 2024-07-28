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
        <h2 class="my-3 py-2 px-3 text-3xl border-4 border-yellow-600">
          <svg class="inline-block w-9 mr-1 -mt-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125Z" />
          </svg>レシピ最新</h2>
        <p class="mb-3"><a href={{route('recipes.index')}} class="underline text-lg">全てのレシピ ></a></p>
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($recipes as $recipe)
               <x-recipes.front-card :recipe="$recipe" />
            @endforeach
        </section>
    </div>

    
    <div class="mx-3">     
        <h2 class="my-3 py-2 px-3 text-3xl border-4 border-cyan-500"><svg class="inline-block w-9 mr-1 -mt-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
          </svg>
          人気レシピ</h2>
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
