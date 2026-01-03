<x-layout>
    <div class="flex items-center mb-4 justify-between">
        <h1 class="text-2xl font-bold mb-4">Edit Customer</h1>
    </div>

    @include('customers._form', [
        'action' => route('customers.update', $customer),
        'method' => 'PUT',
        'buttonText' => 'Update Customer'
    ])
</x-layout>
