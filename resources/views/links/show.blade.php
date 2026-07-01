<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                {{ __('Link Statistics') }}
            </h2>
            <a href="{{ route('links.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition">
                &larr; {{ __('Back to links') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Original URL</dt>
                            <dd class="mt-1 text-sm text-gray-900 break-all">{{ $link->original_url }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Short URL</dt>
                            <dd class="mt-1 text-sm font-mono text-indigo-600 break-all">
                                <a href="{{ url($link->short_code) }}" target="_blank" class="hover:text-indigo-500">{{ url($link->short_code) }}</a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Total Clicks</dt>
                            <dd class="mt-1 text-2xl font-bold text-gray-900">{{ $link->clicks_count }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $link->created_at->format('Y-m-d H:i:s') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Click History</h3>

                    @if ($clicks->isEmpty())
                        <p class="text-gray-500 text-center py-8">No clicks yet. Share your link to see it in action.</p>
                    @else
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3">IP Address</th>
                                    <th class="px-4 py-3">User Agent</th>
                                    <th class="px-4 py-3">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clicks as $click)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="px-4 py-3 font-mono text-xs">{{ $click->ip_address }}</td>
                                        <td class="px-4 py-3 max-w-xs truncate text-xs">{{ $click->user_agent ?? '-' }}</td>
                                        <td class="px-4 py-3 text-xs">{{ $click->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $clicks->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>