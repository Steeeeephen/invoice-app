<x-layout>

    <div class="flex flex-col container mx-auto px-6 py-6">
        <h1 class="text-2xl font-bold mb-4  ">Invoice List</h1>


        <table
            class="min-w-full bg-slate-800 border border-slate-700 my-6 rounded-md overflow-hidden shadow-md shadow-black/40">
            <thead class="bg-slate-700 text-left text-sm uppercase tracking-wider text-gray-400">
            <tr>
                <th class="px-6 py-3">Invoice Number</th>
                <th class="px-6 py-3">Customer</th>
                <th class="px-6 py-3">Company</th>
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
                    <td class="px-6 py-4">{{ $invoice->due_date }}</td>
                    <td class="px-6 py-4">
                        @php
                            $statusClasses = match($invoice->status) {
                                'paid'    => 'bg-green-500/20 text-green-400 border border-green-500/30',
                                'overdue' => 'bg-red-500/20 text-red-400 border border-red-500/30',
                                default   => 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30',
                            };
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                    </td>

            @endforeach
            </tbody>
        </table>
    </div>


</x-layout>
