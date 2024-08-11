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
                <img src="{{ Storage::url(str_replace('public/', '', $recipe->image)) }}" alt="{{ $recipe->title }}" class="w-full h-64 object-contain">
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
        <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">材料</h3>
        <ul class="space-y-3">
            @foreach($recipe->ingredients as $ingredient)
                <li class="flex items-center text-gray-700">
                    <span class="w-2 h-2 bg-indigo-500 rounded-full mr-3"></span>
                    <span class="font-bold text-2xl">{{ $ingredient->name }}:</span>
                    <span class="ml-2 text-gray-600">{{ $ingredient->quantity }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-12 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">手順</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($recipe->steps as $step)
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <span class="w-8 h-8 bg-indigo-500 rounded-full text-white flex items-center justify-center mr-3">{{ $step->step_number }}</span>
                    <h3 class="text-xl font-bold text-gray-800">{{ $step->description }}</h3>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <section class="mt-8">
        <h3 class="text-2xl font-bold mb-4 text-gray-800">レビュー</h3>
        @forelse($recipe->reviews as $review)
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span class="ml-2 text-gray-600">{{ $review->rating }}スター</span>
                </div>
                <p class="text-gray-700">{{ $review->comment }}</p>
                <div class="mt-2 text-sm text-gray-500">
                    投稿者: {{ $review->user->name }} | {{ $review->created_at->format('Y年m月d日') }}
                </div>
            </div>
        @empty
            <p class="text-gray-600">まだレビューがありません。</p>
        @endforelse
    </section>

      <div class="mt-8 text-center">
          <a href="{{ route('recipe.index') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-2 px-6 rounded-full hover:from-blue-600 hover:to-purple-700 transition duration-300">
              レシピ一覧に戻る
          </a>
      </div>
  </div>
</x-app-layout>