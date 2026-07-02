<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'ShortCutter') }} — URL Shortener</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    @php
        $displayDomain = config('app.url') && !str_contains(config('app.url'), 'localhost')
            ? rtrim(config('app.url'), '/')
            : 'https://shortcutter.test';
    @endphp
    <body class="font-sans antialiased bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="min-h-screen flex flex-col">
            <nav class="flex items-center justify-between px-6 py-4 w-full lg:w-[90%] xl:w-4/5 mx-auto">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">{{ config('app.name', 'ShortCutter') }}</span>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Sign in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                Get started
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>

            <main class="flex-1 flex items-center">
                <div class="w-4/5 mx-auto px-6 py-16">
                    <div class="text-center">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight tracking-tight">
                            Shorten links.<br>
                            <span class="text-indigo-600">Track clicks.</span>
                        </h1>
                        <p class="mt-4 text-lg text-gray-500 max-w-lg mx-auto">
                            Create short, memorable links in seconds. Share them anywhere and track every click with detailed analytics.
                        </p>

                        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                    Go to Dashboard
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                    Start shortening — it's free
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50 transition">
                                    Sign in
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="mt-16 w-full mx-auto">
                        <div class="bg-white rounded-2xl p-8 border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 bg-gray-100 rounded-lg px-4 py-3 text-sm text-gray-400 font-mono truncate">
                                        https://example.com/very-long-url
                                    </div>
                                    <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 bg-indigo-50 border border-indigo-100 rounded-lg px-4 py-3 text-sm text-indigo-700 font-mono font-medium truncate">
                                        {{ $displayDomain }}/aB3xK9
                                    </div>
                                    <button class="p-2 text-gray-400 hover:text-indigo-600 transition" title="Copy">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="pt-2 flex items-center justify-between text-sm text-gray-500 border-t border-gray-100">
                                    <span>Clicked 142 times</span>
                                    <span>Created 2 days ago</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 grid grid-cols-3 gap-8 w-full mx-auto">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900" id="stat-links">0</div>
                            <div class="text-sm text-gray-500">Links created</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900" id="stat-clicks">0</div>
                            <div class="text-sm text-gray-500">Clicks tracked</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900" id="stat-users">0</div>
                            <div class="text-sm text-gray-500">Users</div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-6 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'ShortCutter') }}. Built with Laravel.
            </footer>
        </div>

        @php
            $s = ['links' => 0, 'clicks' => 0, 'users' => 0];
            if (\Illuminate\Support\Facades\Schema::hasTable('short_links')) {
                $s['links'] = \App\Models\ShortLink::count();
                $s['clicks'] = \App\Models\ShortLink::sum('clicks_count');
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('users')) {
                $s['users'] = \App\Models\User::count();
            }
        @endphp
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const el = (id, val) => {
                    const el = document.getElementById(id);
                    if (el) {
                        let i = 0;
                        const step = Math.ceil(val / 30) || 1;
                        const iv = setInterval(() => {
                            i += step;
                            if (i >= val) { i = val; clearInterval(iv); }
                            el.textContent = i;
                        }, 40);
                    }
                };
                el('stat-links', {{ $s['links'] }});
                el('stat-clicks', {{ $s['clicks'] }});
                el('stat-users', {{ $s['users'] }});
            });
        </script>
    </body>
</html>