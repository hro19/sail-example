<x-app-layout>
    <x-wrap.card title="学生詳細" content="学生の詳細情報です" />
    <div class="m-3 text-3xl">
        <p>ID: {{ $student->id }}</p>
        <p>名前: {{ $student->name }}</p>
        <p>メールアドレス: {{ $student->email }}</p>
        {{-- 他の属性も必要に応じて表示 --}}
    </div>
</x-app-layout>