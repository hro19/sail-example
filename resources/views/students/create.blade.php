<x-app-layout>
    <x-wrap.card title="学生作成" content="新しい学生を作成できます" />
    <form action="{{ route('students.store') }}" method="POST" class="space-y-4"> 
        @csrf
    
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">名前:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
            @error('name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
            @error('email')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    
        {{-- 他の属性の入力フィールドも必要に応じて追加 --}}
    
        <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">作成</button>
    </form>
</x-app-layout>