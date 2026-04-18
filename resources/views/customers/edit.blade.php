@section('title')
    Editing {{ $customer->first_name}} {{$customer->last_name }}
@endsection

<x-layout>
    <div class="flex justify-center items-center flex-col">
        @include(
            "customers._form",
            [
                "action" => route("customers.update", $customer),
                "method" => "PUT",
                "buttonText" => "Update Customer",
                "title" => "Editing Customer",
            ]
        )
    </div>
</x-layout>
