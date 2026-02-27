<x-layout>
    <div class="flex justify-center items-center flex-col">
        @include(
            "invoices._form",
            [
                "title" => "Create an Invoice",
                "action" => route("invoices.store"),
                "method" => "POST",
                "buttonText" => "Create Invoice",
                "operation" => "Creating an Invoice for ",
            ]
        )
    </div>
</x-layout>
