<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Neues Ticket erstellen
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form action="{{ route('tickets.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Beschreibung</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" required></textarea>
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700">Priorität</label>
                <select name="priority" id="priority" class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="Low">Niedrig</option>
                    <option value="Medium">Mittel</option>
                    <option value="High">Hoch</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Absenden</button>
        </form>
    </div>
</x-app-layout>
