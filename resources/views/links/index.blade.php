@auth
    @php
        $layout = 'layouts.app';
    @endphp
@else
    @php
        $layout = 'layouts.guest';
    @endphp
@endauth

<x-{{ $layout }}>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Short Links') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="POST" action="{{ route('links.store') }}" class="flex gap-4">
                        @csrf
                        <input type="url" name="original_url" placeholder="https://example.com/page" required
                            class="flex-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Create Link
                        </button>
                    </form>
                    @error('original_url')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($links->isEmpty())
                        <p class="text-gray-500 text-center">No links yet. Create your first one above!</p>
                    @else
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3">Short URL</th>
                                    <th class="px-4 py-3">Original URL</th>
                                    <th class="px-4 py-3">Clicks</th>
                                    <th class="px-4 py-3">Created</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($links as $link)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-mono text-indigo-600">
                                            <a href="{{ url($link->short_code) }}" target="_blank">
                                                {{ url($link->short_code) }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 max-w-xs truncate">{{ $link->original_url }}</td>
                                        <td class="px-4 py-3">{{ $link->clicks_count }}</td>
                                        <td class="px-4 py-3">{{ $link->created_at->diffForHumans() }}</td>
                                        <td class="px-4 py-3 flex gap-2">
                                            <a href="{{ route('links.show', $link) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Stats</a>
                                            <form method="POST" action="{{ route('links.destroy', $link) }}"
                                                onsubmit="return confirm('Delete this link?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $links->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-{{ $layout }}>
