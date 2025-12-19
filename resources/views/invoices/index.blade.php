<x-layout>

    <div class="flex items-center mb-4 justify-between">
        <h1 class="text-2xl font-bold mb-4  ">Invoice List</h1>
    </div>

    <table class="min-w-full bg-gray-100  shadow-md rounded-md overflow-hidden">
        <thead class="bg-gray-200  text-left text-sm uppercase tracking-wider text-gray-800 ">
        <tr>
            <th class="px-6 py-3">Invoice Number</th>
            <th class="px-6 py-3">Customer</th>
            <th class="px-6 py-3">Company</th>
            <th class="px-6 py-3">Due Date</th>
            {{--            <th class="px-6 py-3">State</th>--}}
        </tr>
        </thead>
        <tbody class="text-sm text-gray-900 ">
        @foreach ($invoices as $invoice)
            <tr class="border-t border-gray-300  hover:bg-green-100  transition-colors">

                <td class="px-6 py-4">
                    <a href="{{ route('invoices.show', $invoice->id) }}"
                       class="text-blue-600 hover:underline dark:text-blue-400">
                        {{ $invoice->invoice_number }}
                    </a>
                </td>

                <td class="px-6 py-4">{{ $invoice->customer->first_name }} {{ $invoice->customer->last_name }}</td>
                <td class="px-6 py-4">{{ $invoice->customer->company_name }}</td>
                <td class="px-6 py-4">{{ $invoice->due_date }}</td>





            </tr>
        @endforeach
        </tbody>
    </table>




</x-layout>
