@section('title')
    Creating an Invoice for {{$customer->first_name}} {{$customer->last_name}}
@endsection

<x-layout>
    <div class="flex justify-center items-center flex-col">
        @include(
            "invoices._form",
            [
                "title" => "Creating an Invoice for $customer->first_name $customer->last_name",
                "action" => route("invoices.store"),
                "method" => "POST",
                "buttonText" => "Create Invoice",
            ]
        )
    </div>
</x-layout>
