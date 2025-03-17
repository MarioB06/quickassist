<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticket-Kategorien
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <!-- Erfolgsnachricht -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formular zum Erstellen einer neuen Kategorie -->
            <form action="{{ route('ticket-categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Kategorie Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Erstellen</button>
            </form>

            <!-- Liste der vorhandenen Kategorien -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold">Bestehende Kategorien</h3>
                <ul class="mt-2 space-y-2">
                    @foreach($categories as $category)
                        <li class="p-2 border rounded bg-gray-100">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
