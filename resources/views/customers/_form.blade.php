<form action="{{ $action }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    @foreach([
    'first_name' => 'First Name',
    'last_name' => 'Last Name',
    'company_name' => 'Company Name',
    'email' => 'Email',
    'phone' => 'Phone Number',
    'street_address' => 'Street Address',
    'city' => 'City',
    'state' => 'State',
    'zip' => 'Zip'


    ] as $field => $label)
        <div >
            <label
                for="$field"
                class="font-semibold"

            >
                {{ $label }}
            </label>
            <input
                class="w-full rounded px-3 py-2 mb-4 bg-zinc-100"
                type="text"
                id="{{ $field }}"
                name=" {{ $field }}"
                @if( in_array($field, ['first_name', 'last_name', 'email']) ) required @endif
                value="{{ old($field, $customer->$field ?? '') }}"
                {{--
                 Use old() to repopulate form fields after a failed validation.
                 If no old input exists, use the existing value from the customer model.
                 If that’s also null, fall back to an empty string.
                 --}}
            >
        </div>
    @endforeach

    <button class="bg-blue-600 text-white text-sm my-6 px-4 py-2 rounded hover:bg-blue-700 mr-6 cursor-pointer">
        {{ $buttonText }}
    </button>
</form>
