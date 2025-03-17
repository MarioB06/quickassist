<x-guest-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form action="{{ route('tickets.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="titel" class="block text-sm font-medium text-gray-700">Titel</label>
                <input type="text" name="titel" id="titel" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="beschreibung" class="block text-sm font-medium text-gray-700">Beschreibung</label>
                <textarea name="beschreibung" id="beschreibung" rows="4" class="mt-1 block w-full border-gray-300 rounded-md" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Absenden</button>
        </form>

        <div class="mt-6 text-center">
            @auth
                @if(auth()->user())
                    <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Admin-Dashboard</a>
                @else
                    <p class="text-gray-700">Angemeldet als {{ auth()->user()->name }}</p>
                @endif
            @else
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Als Admin anmelden</a>
            @endauth
        </div>
    </div>
</x-guest-layout>
