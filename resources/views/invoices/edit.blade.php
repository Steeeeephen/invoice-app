<x-layout>
    <div class="flex justify-center items-center flex-col">
        @include(
            "invoices._form",
            [
                "action" => route("invoices.update", $invoice),
                "method" => "PUT",
                "buttonText" => "Update Invoice",
                "title" => "Editing invoice '{$invoice->invoice_number}' for  {$invoice->customer->first_name} {$invoice->customer->last_name}",
            ]
        )
    </div>
</x-layout>
