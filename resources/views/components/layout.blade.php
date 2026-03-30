<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ICM App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-gray-100 min-h-screen flex flex-col">

<nav class="bg-slate-800 border-b border-slate-700 shadow-md">
    <div class="flex justify-between items-center px-6 py-4 max-w-7xl mx-auto">

        <a href="/" class="text-xl font-bold text-blue-400 hover:text-blue-300 transition-colors">
            ICM App
        </a>

        @auth
            <ul class="flex gap-6">

                {{--        Conditionally rendering the 'User' link in the nav bar. This could also be done with @can or @role but this seems to work just fine.        --}}
                @if(auth()->user()->role === 'super_admin')
                    <li>
                        <a href="{{ route('users.index') }}"
                           class="text-slate-300 hover:text-white font-medium transition-colors">
                            Users
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('customers.index') }}"
                       class="text-slate-300 hover:text-white font-medium transition-colors">
                        Customers
                    </a>
                </li>
                <li>
                    <a href="{{ route('invoices.index') }}"
                       class="text-slate-300 hover:text-white font-medium transition-colors">
                        Invoices
                    </a>
                </li>
                <li>
                    <a href="#" class="text-slate-300 hover:text-white font-medium transition-colors">
                        Projects
                    </a>
                </li>

                <li>
                    <a href="{{ route('invoices.test.index') }}"  class="text-slate-300 hover:text-white font-medium transition-colors">
                        Invoice Test
                    </a>
                </li>
            </ul>

            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-400">
                    <a href="{{ route('profile.edit') }}">
                        {{ Auth::user()->first_name }}
                    </a>
                </span>
                <form action="/logout" method="POST">
                    @csrf
                    <button
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition-colors text-sm font-medium cursor-pointer">
                        Log Out
                    </button>
                </form>
            </div>
        @endauth

    </div>
</nav>

{{-- Flash Messages --}}
@php
    $flashTypes = [
        'success' => ['bg' => 'bg-green-500/10 border-green-500/30 text-green-400', 'icon' => '✓'],
        'error'   => ['bg' => 'bg-red-500/10 border-red-500/30 text-red-400', 'icon' => '✕'],
    ];
@endphp

<div class="max-w-7xl mx-auto w-full px-6 mt-4 space-y-2">
    @foreach($flashTypes as $type => $config)
        @if(session($type))
            <div
                class="flash-message {{ $config['bg'] }} border rounded-lg px-4 py-3 text-sm flex items-center gap-2 transition-opacity duration-500">
                <span>{{ $config['icon'] }}</span>
                <span>{{ session($type) }}</span>
            </div>
        @endif
    @endforeach
</div>

<main class="flex-1">
    {{ $slot }}
</main>

</body>
</html>
