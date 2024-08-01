<x-app-layout>
    {{-- 成功メッセージの表示 --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <x-wrap.card title="レシピ詳細" content="登録されているレシピ詳細" />


    <p class="mb-3">
        <a href="{{ route('recipe.index') }}" class="underline text-gray-800 text-2xl">レシピ一覧 ></a>
    </p>
    <p class="mb-3">
        <a href="{{ route('recipe.create') }}" class="underline text-gray-800 text-2xl">レシピ新規追加 ></a>
    </p>

    <div class="container mx-auto px-4 py-8">
      <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">レシピ詳細</h1>
  
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
          <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-4">
              <h2 class="text-2xl font-bold text-white">{{ $recipe->title }}</h2>
          </div>

          <div>
            <figure class="w-full mt-6">
              <img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="w-full h-64 object-contain">
            </figure>
          </div>
  
          <div class="p-6">
              <section class="mb-8">
                  <h3 class="text-xl font-semibold mb-4 text-gray-700 border-b-2 border-blue-500 pb-2">基本情報</h3>
                  <div class="grid grid-cols-2 gap-4">
                      <p class="text-gray-600"><span class="font-medium text-gray-800">ID:</span> {{ $recipe->id }}</p>
                      <p class="text-gray-600"><span class="font-medium text-gray-800">カテゴリー:</span> {{ $recipe->category->name }}</p>
                      <p class="text-gray-600"><span class="font-medium text-gray-800">作成者:</span> {{ $recipe->user->name }}</p>
                      <p class="text-gray-600"><span class="font-medium text-gray-800">作成日時:</span> {{ $recipe->created_at->format('Y年m月d日 H:i') }}</p>
                  </div>
              </section>
  
              <section class="mb-8">
                  <h3 class="text-xl font-semibold mb-4 text-gray-700 border-b-2 border-purple-500 pb-2">評価と閲覧情報</h3>
                  <div class="flex justify-around items-center">
                      <div class="text-center">
                          <p class="text-3xl font-bold text-yellow-500">{{ number_format($rating, 2) }}</p>
                          <p class="text-gray-600">評価値</p>
                      </div>
                      <div class="text-center">
                          <p class="text-3xl font-bold text-blue-500">{{ $recipe->views }}</p>
                          <p class="text-gray-600">閲覧数</p>
                      </div>
                  </div>
              </section>
          </div>
      </div>
      
    <div class="mt-12 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">手順</h3>
        <ol class="space-y-3">
            @foreach($recipe->steps as $step)
                <li class="flex items-start">
                    <span class="w-8 h-8 bg-indigo-500 rounded-full text-white flex items-center justify-center mr-3">{{ $step->step_number }}</span>
                    <span class="text-gray-700">{{ $step->description }}</span>
                </li>
            @endforeach
        </ol>
    </div>
      <div class="mt-8 text-center">
          <a href="{{ route('recipe.index') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-2 px-6 rounded-full hover:from-blue-600 hover:to-purple-700 transition duration-300">
              レシピ一覧に戻る
          </a>
      </div>
  </div>
</x-app-layout>