<x-layout>
    <div class="min-h-screen flex justify-center bg-slate-900 px-4">
        @guest
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white">Welcome back</h1>
                    <p class="text-slate-400 mt-2">Sign in to your account to continue</p>
                </div>

                <form class="bg-slate-800 rounded-xl shadow-xl p-8 space-y-6" action="/login" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-lg px-4 py-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-300" for="email">Email address</label>
                        <input
                            class="w-full bg-slate-700 text-white rounded-lg px-4 py-2.5 text-sm border border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-slate-400"
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="email"
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-300" for="password">Password</label>
                        <input
                            class="w-full bg-slate-700 text-white rounded-lg px-4 py-2.5 text-sm border border-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-slate-400"
                            type="password"
                            name="password"
                            id="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                        >
                    </div>

                    <button
                        class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-lg px-4 py-2.5 text-sm transition-colors duration-150"
                        type="submit"
                    >
                        Sign in
                    </button>
                </form>

                <div class="text-center mt-6 text-lg">To see more, please use the following login credentials:
                    <div>Email: demo@superadmin.com</div>
                    <div>Password: admin</div>
                </div>
            </div>
        @endguest

        @auth
            <div class="text-center">
                <h2 class="text-2xl font-semibold text-white">Hello, {{ Auth::user()->first_name }}.</h2>
                <p class="text-slate-400 mt-1">You're signed in.</p>
            </div>
        @endauth

    </div>
</x-layout>
