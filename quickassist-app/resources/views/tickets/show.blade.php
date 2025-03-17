<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticket Details: {{ $ticket->titel }}
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

            <!-- Ticket Infos -->
            <div class="mb-6">
                <p><strong>Beschreibung:</strong> {{ $ticket->beschreibung }}</p>
                <p><strong>Zugewiesen an:</strong> {{ $ticket->assigned_to ? $ticket->assignedUser->name : 'Keiner' }}
                </p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                <p><strong>Wichtigkeit:</strong> {{ ucfirst($ticket->prioritaet) }}</p>
                <p><strong>Kategorie:</strong> {{ $ticket->category_id ? $ticket->category->name : 'Keine' }}</p>
            </div>

            <!-- Formular zum Bearbeiten -->
            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="space-y-4">
                @csrf

                <!-- Wichtigkeit -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Wichtigkeit</label>
                    <select name="prioritaet" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="niedrig" {{ $ticket->prioritaet == 'niedrig' ? 'selected' : '' }}>Niedrig</option>
                        <option value="mittel" {{ $ticket->prioritaet == 'mittel' ? 'selected' : '' }}>Mittel</option>
                        <option value="hoch" {{ $ticket->prioritaet == 'hoch' ? 'selected' : '' }}>Hoch</option>
                    </select>
                </div>

                <!-- Selbst zuweisen -->
                @if(!$ticket->assigned_to)
                    <div>
                        <input type="checkbox" name="assign_self" id="assign_self" class="mr-2">
                        <label for="assign_self" class="text-sm font-medium text-gray-700">Mir selbst zuweisen</label>
                    </div>
                @endif

                <!-- Status ändern -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="offen" {{ $ticket->status == 'offen' ? 'selected' : '' }}>Offen</option>
                        <option value="in_bearbeitung" {{ $ticket->status == 'in_bearbeitung' ? 'selected' : '' }}>In
                            Bearbeitung</option>
                        <option value="geschlossen" {{ $ticket->status == 'geschlossen' ? 'selected' : '' }}>Geschlossen
                        </option>
                    </select>
                </div>

                <!-- Kategorie zuweisen -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategorie</label>
                    <select name="category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Keine Kategorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Änderungen speichern</button>
            </form>
        </div>
        <!-- Kommentar-Verlauf -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold">Kommentare</h3>
            <div class="mt-4 space-y-4">
                @forelse($comments as $comment)
                    <div class="p-4 bg-gray-100 rounded-md">
                        <p class="text-sm text-gray-700"><strong>{{ $comment->user->name }}</strong> schrieb:</p>
                        <p class="text-gray-900">{{ $comment->kommentar }}</p>
                        <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Noch keine Kommentare vorhanden.</p>
                @endforelse
            </div>
        </div>

        <!-- Kommentar hinzufügen -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold">Neuen Kommentar hinterlassen</h3>
            <form action="{{ route('ticket-comments.store', $ticket->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="kommentar" class="block text-sm font-medium text-gray-700">Kommentar</label>
                    <textarea name="kommentar" id="kommentar" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md" required></textarea>
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Kommentar senden</button>
            </form>
        </div>

    </div>
</x-app-layout>