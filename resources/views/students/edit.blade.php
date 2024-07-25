<x-app-layout>
    <x-wrap.card title="学生編集" content="学生情報を編集できます" />

    <div class="m-4">
        <h2 class="text-2xl mb-3">【生徒ID】{{ $student->id}}</h2>
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name">名前:</label>
                <input type="text" id="name" name="name" value="{{ $student->name }}" required>
            </div>

            <div class="mb-4">
                <label for="email">メールアドレス:</label>
                <input type="email" id="email" name="email" value="{{ $student->email }}" required>
            </div>

            {{-- 他の属性の入力フィールドも必要に応じて追加 --}}

            <button type="submit" class="px-6 py-2 text-white bg-green-500">更新</button>
        </form>
    </div>
</x-app-layout>