<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-wrap.card title="学生作成" content="新しい学生を作成できます" />
                    
                    <form action="{{ route('students.store') }}" method="POST" class="mt-8 space-y-6"> 
                        @csrf
                    
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                                <div class="mt-1">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">好物</label>
                            <div id="preferences-container" class="mt-2 space-y-3">
                                @for ($i = 0; $i < 1; $i++) 
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="preferences[]" value="{{ old('preferences.' . $i) }}" 
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 remove-preference">
                                            削除
                                        </button>
                                    </div>
                                @endfor
                            </div>
                            <button type="button" id="add-preference" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                好物を追加
                            </button>
                        </div>
                    
                        <div class="pt-5">
                            <div class="flex justify-end">
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    作成
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const addPreferenceButton = document.getElementById('add-preference');
        const preferencesContainer = document.getElementById('preferences-container');
        let preferenceCount = 1; // 初期は3つの入力フィールド

        addPreferenceButton.addEventListener('click', () => {
            const newPreferenceInput = `
                <div class="flex items-center space-x-2">
                    <input type="text" id="preference_${preferenceCount}" name="preferences[]" 
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 remove-preference">
                        削除
                    </button>
                </div>
            `;
            preferencesContainer.insertAdjacentHTML('beforeend', newPreferenceInput);
            preferenceCount++;
        });

        preferencesContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-preference')) {
                event.target.closest('div').remove();
                preferenceCount--; 
            }
        });
        
    </script>
</x-app-layout>