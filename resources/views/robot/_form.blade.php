<div x-data="{ command: ' ' }">
    <div class="flex items-center justify-between max-w-sm mx-auto">
        <button @click="command += 'N '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            N
        </button>
        <button @click="command += 'W '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            W
        </button>
        <button @click="command += 'E '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            E
        </button>
        <button @click="command += 'S '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            S
        </button>
    </div>

    <form method="post" action="{{ route('robot.move', ['xLocation' => $xLocation, 'yLocation' => $yLocation]) }}"
        class="w-full max-w-sm mx-auto my-3">
        @csrf
        <div class="flex items-center border-b border-teal-500 py-2">
            <input
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                name="command" type="text" aria-label="Command" x-model="command" readonly>
            <button
                class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded-full"
                type="submit">
                Exe
            </button>
            <a class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded"
                href="{{ route('robot.index') }}">
                Clear
            </a>
        </div>
    </form>

    @if ($errors->any())
    <div class="p-2 text-red-500 max-w-sm min-w-sm">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</div>
