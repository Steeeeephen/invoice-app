<h1 class="text-2xl font-bold mb-6 text-gray-100">{{ $title }}</h1>

<form
    action="{{ $action }}"
    method="POST"
    class="w-1/2"
>
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    @foreach([
        'first_name'     => 'First Name',
        'last_name'      => 'Last Name',
        'company_name'   => 'Company Name',
        'email'          => 'Email',
        'phone'          => 'Phone Number',
        'street_address' => 'Street Address',
        'city'           => 'City',
        'state'          => 'State',
        'zip'            => 'Zip'
    ] as $field => $label)
        <div class="mb-4">
            <label
                for="{{ $field }}"
                class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
            >
                {{ $label }}
                @if(in_array($field, ['first_name', 'last_name', 'email']))
                    <span class="text-red-400">*</span>
                @endif
            </label>
            <input
                class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                type="text"
                id="{{ $field }}"
                name="{{ $field }}"
                @if(in_array($field, ['first_name', 'last_name', 'email'])) required @endif
                value="{{ old($field, $customer->$field ?? '') }}"
                {{--
                 Use old() to repopulate form fields after a failed validation.
                 If no old input exists, use the existing value from the customer model.
                 If that's also null, fall back to an empty string.
                --}}
            >
            @error($field)
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    @endforeach

    <button class="bg-indigo-600 text-white text-sm mt-4 px-4 py-2 rounded hover:bg-indigo-500 cursor-pointer font-semibold">
        {{ $buttonText }}
    </button>
</form>
