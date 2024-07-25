<x-app-layout>
    <x-wrap.card title="学生" content="学生一覧ページです" />

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