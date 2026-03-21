<h1 class="text-2xl font-bold mb-6 text-gray-100">
    {{ $title }}
</h1>

<form action="{{ $action }}" method="POST" class="w-1/2">
    @csrf
    @if ($method === "PUT")
        @method("PUT")
    @endif

    <div class="mb-4">
        <label
            for="first_name"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            First Name
        </label>
        <input
            type="text"
            id="first_name"
            name="first_name"
            class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            value="{{ old('first_name', $user->first_name ?? "") }}"
        />
        <x-input-error name="first_name"></x-input-error>
    </div>

    <div class="mb-4">
        <label
            for="last_name"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            Last Name
        </label>

        <input
            type="text"
            id="last_name"
            name="last_name"
            class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            value="{{ old('last_name', $user->last_name ?? "") }}"
        />

        <x-input-error name="last_name"></x-input-error>
    </div>

    <div class="mb-4">
        <label
            for="email"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
            value="{{ old('email', $user->email ?? "") }}"
        />
        <x-input-error name="email"></x-input-error>

    </div>

    <div class="mb-4">
        <label
            for="password"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            Password
        </label>
        <input
            type="password"
            id="password"
            name="password"
            class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        />
        <x-input-error name="password"></x-input-error>
    </div>

    <div class="mb-4">
        <label
            for="password_confirmation"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            Confirm Password
        </label>

        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        />
        <x-input-error name="password_confirmation"></x-input-error>
    </div>

    @php
        $roles = ["super_admin" => "Super Admin", "admin" => "Admin", "client" => "Client"];
    @endphp

    @if(auth()->user()->role === 'super_admin')

    <div class="mb-4">
        <label
            for="role"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            User Role
        </label>
        <select
            name="role"
            id="role"
            required
            class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        >
            <option
                value=""
                disabled
                {{ old("role", $user->role ?? "") === "" ? "selected" : "" }}
            >
                -- Select Role --
            </option>

            @foreach ($roles as $value => $label)
                <option
                    value="{{ $value }}"
                    {{ old("role", $user->role ?? "") === $value ? "selected" : "" }}
                >
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <x-input-error name="role"></x-input-error>
    </div>

    @endif

    <button
        type="submit"
        class="bg-indigo-600 text-white text-sm mt-4 px-4 py-2 rounded hover:bg-indigo-500 cursor-pointer font-semibold"
    >
        {{ $buttonText }}
    </button>
</form>
