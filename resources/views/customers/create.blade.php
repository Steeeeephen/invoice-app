<x-layout>
    <h1 class="text-2xl font-bold mb-4">Create a Customer</h1>
    @include('customers._form', [
        'action' => route('customers.store'),
        'method' => 'POST',
        'buttonText' => 'Create Customer'
    ])
</x-layout>
