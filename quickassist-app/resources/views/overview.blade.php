<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Meine Tickets
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('tickets.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Neues Ticket</a>
        </div>

        <h3 class="text-lg font-medium">Offene Tickets</h3>
        <ul class="space-y-2">
            @foreach ($openTickets as $ticket)
                <li class="p-4 border rounded">
                    <a href="{{ route('tickets.show', $ticket->id) }}" class="font-semibold">{{ $ticket->title }}</a>
                    <span class="ml-2 text-gray-600">({{ $ticket->priority }})</span>
                </li>
            @endforeach
        </ul>

        <h3 class="text-lg font-medium mt-6">Geschlossene Tickets</h3>
        <ul class="space-y-2">
            @foreach ($closedTickets as $ticket)
                <li class="p-4 border rounded bg-gray-100">
                    <a href="{{ route('tickets.show', $ticket->id) }}" class="font-semibold">{{ $ticket->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
