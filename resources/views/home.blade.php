<x-app-layout>
    {{-- 成功メッセージの表示 --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <p class="py-3 bg-lime-300">トップページです</p>

    <div class="relative bg-center bg-gray-200 selection:bg-red-500 py-4">
        <div class="mb-8">
            <x-alpine.data />
        </div>
        <div class="mb-8">
            <x-alpine.open />
        </div>
    </div>



</x-app-layout> 
