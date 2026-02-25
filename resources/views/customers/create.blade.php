<x-layout>
    <div class="flex justify-center items-center flex-col">

    @include('customers._form', [
        'title' => 'Create a Customer',
        'action' => route('customers.store'),
        'method' => 'POST',
        'buttonText' => 'Create Customer'
    ])

    </div>


</x-layout>
