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
                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50   
   
"
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
                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50   
"
            >
            @error('email')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <d   
iv id="preferences-container">
            @for ($i = 0; $i < 3; $i++) 
                <div class="mb-4 flex items-center">
                    <label for="preference_{{ $i }}" class="block text-sm font-medium text-gray-700">好物 {{ $i + 1 }}:</label>
                    <input 
                        type="text" 
                        id="preference_{{ $i }}" 
                        name="preferences[]" 
                        value="{{ old('preferences.' . $i) }}" 
                        class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >
                    <butt   
on type="button" class="ml-2 px-4 py-2 text-white bg-red-500 remove-preference">削除</button>
                </div>
            @endfor
        </div>

        <button type="button" id="add-preference" class="px-6 py-2 text-white bg-blue-500 mb-4">Add Preference</button>
    
        <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">作成</button>
    </form>

    <script>
        const addPreferenceButton = document.getElementById('add-preference');
        const preferencesContainer = document.getElementById('preferences-container');
        let preferenceCount = 3; // 初期は3つの入力フィールド

        addPreferenceButton.addEventListener('click', () => {
            const newPreferenceInput = `
                <div class="mb-4 flex items-center">
                    <label for="preference_${preferenceCount}">好物 ${preferenceCount + 1}:</label>
                    <input type="text" id="preference_${preferenceCount}" name="preferences[]">
                    <button type="button" class="ml-2 px-4 py-2 text-white bg-red-500 remove-preference">削除</button>
                </div>
            `;
            preferencesContainer.insertAdjacentHTML('beforeend', newPreferenceInput);
            preferenceCount++;
        });

        preferencesContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-preference')) {
                event.target.parentElement.remove();
                preferenceCount--; 
            }
        });
    </script>
</x-app-layout>