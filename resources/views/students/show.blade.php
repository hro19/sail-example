<x-app-layout>
    <x-wrap.card title="学生詳細" content="学生の詳細情報です" />
    <div class="m-3 text-3xl">
        <p>ID: {{ $student->id }}</p>
        <p>名前: {{ $student->name }}</p>
        <p>メールアドレス: {{ $student->email }}</p>
        {{-- 他の属性も必要に応じて表示 --}}

        @foreach($student->preferences as $preference)
        <article class="border-4 border-blue-500 p-3 ml-2">
            <p>preferenceのID: {{ $preference->id }}</p>
            <p>名前: {{ $preference->name }}</p>
            <p>生成日: {{ $preference->created_at }}</p>
        </article>
        @endforeach
    </div>
</x-app-layout>