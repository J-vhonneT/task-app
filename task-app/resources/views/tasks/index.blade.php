<!DOCTYPE html>
<html>
<head>
    <title>Task App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-100 h-screen flex items-center justify-center font-sans">

<div class="absolute top-4 right-4">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-pink-600 transition">
            Logout
        </button>
    </form>
</div>

<div class="w-full max-w-lg bg-white p-8 rounded-xl shadow-lg">

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Task Manager</h1>

    <!-- Add Task -->
    <div class="mb-6">
        <form method="POST" action="{{ route('tasks.store') }}" class="flex gap-3">
            @csrf
            <input type="text" name="title"
                   class="border-gray-200 bg-gray-50 p-3 flex-1 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition"
                   placeholder="Add a new task..." required>

            <button class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-5 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-75">
                Add
            </button>
        </form>
    </div>

    <!-- Task List -->
    <div class="space-y-4">
        @forelse($tasks as $task)
            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">

                <div class="flex items-center">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PATCH')
                        <button class="w-6 h-6 flex items-center justify-center rounded-full border-2 {{ $task->is_done ? 'border-pink-500 bg-pink-500' : 'border-gray-300' }} hover:bg-gray-100 transition">
                            @if($task->is_done)
                                <span class="text-white text-xs">✔</span>
                            @endif
                        </button>
                    </form>

                    <span class="ml-4 text-lg {{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-700' }}">
                        {{ $task->title }}
                    </span>
                </div>

                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="flex items-center">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:text-red-700 font-semibold transition">
                        Delete
                    </button>
                </form>

            </div>
        @empty
            <p class="text-gray-500 text-center py-4">All clear! No tasks for today.</p>
        @endforelse
    </div>

</div>
</body>
</html>