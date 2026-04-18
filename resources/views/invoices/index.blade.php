@section('title')
    Invoice List
@endsection

<x-layout>
    <div class="flex flex-col container mx-auto px-6 py-6">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold mb-4  ">Invoice List</h1>
            <x-invoice-filter></x-invoice-filter>
        </div>


        <table
            class="min-w-full bg-slate-800 my-6 rounded-md overflow-hidden shadow-md shadow-black/40">
            <thead class="bg-slate-700 text-left text-sm uppercase tracking-wider text-gray-400">
            <tr>
                <th class="px-6 py-3">Invoice Number</th>
                <th class="px-6 py-3">Customer</th>
                <th class="px-6 py-3">Company</th>
                <th class="px-6 py-3">Amount Due</th>
                <th class="px-6 py-3">Due Date</th>
                <th class="px-6 py-3">Status</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
            @foreach ($invoices as $invoice)
                <tr class="hover:bg-slate-700/50 transition-colors cursor-pointer"
                    onclick="window.location='{{route('invoices.show', $invoice)}}'">
                    <td class="px-6 py-4">{{ $invoice->invoice_number }}</td>
                    <td class="px-6 py-4">{{ $invoice->customer->first_name }} {{ $invoice->customer->last_name }}</td>
                    <td class="px-6 py-4">{{ $invoice->customer->company_name }}</td>
                    <td class="px-6 py-4">{{ $invoice->amount_due }}</td>
                    <td class="px-6 py-4">{{ $invoice->due_date }}</td>
                    <td class="px-6 py-4">
                        <x-invoice-status :status="$invoice->status"/>
                    </td>

            @endforeach
            </tbody>
        </table>
    </div>


</x-layout>
