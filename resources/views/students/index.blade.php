<x-app-layout>
    {{-- 成功メッセージの表示 --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <x-wrap.card title="学生" content="学生一覧ページです" />

    <p class="mb-3"><a href="/students/create" class="underline text-gray-800 text-2xl">学生新規追加 ></a></p>

    <table class="border border-gray-800">
        <thead class="border border-gray-800">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="border-t border-gray-300">
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a href="{{ route('students.show', $student) }}" class="inline-block px-3 py-2 bg-blue-200">View</a>
                        <a href="{{ route('students.edit', $student) }}" class="inline-block px-3 py-2 bg-green-200">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline-block px-3 py-2 bg-pink-200">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout> 