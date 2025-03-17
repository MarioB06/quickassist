<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tickets Eingang
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <!-- Filter Buttons -->
        <div class="mb-4 flex space-x-4">
            <a href="{{ route('dashboard') }}" 
                class="px-4 py-2 rounded {{ request('filter') ? 'bg-gray-300' : 'bg-blue-500 text-white' }}">
                Alle Tickets
            </a>
            <a href="{{ route('dashboard', ['filter' => 'mine']) }}" 
                class="px-4 py-2 rounded {{ request('filter') == 'mine' ? 'bg-blue-500 text-white' : 'bg-gray-300' }}">
                Meine Tickets
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->titel }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($ticket->status) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('tickets.show', $ticket->id) }}"
                                    class="text-blue-500 hover:underline">Anzeigen</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
