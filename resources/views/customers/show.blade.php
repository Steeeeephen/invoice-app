<x-layout>
    <div class="flex flex-col container mx-auto px-6 py-6">
        <div class="flex justify-between items-center">
            <h1 class="text-6xl font-bold text-gray-100">
                {{ $customer->first_name }} {{ $customer->last_name }}
            </h1>

            <a
                href="{{ route('customers.edit', $customer->id) }}"
                class="bg-violet-900 font-bold rounded p-2 text-white hover:bg-violet-700 cursor-pointer"
            >
                Edit Customer
            </a>
        </div>



        <section class="min-w-full bg-slate-800 border border-slate-700 my-6 p-4 shadow-md rounded-md overflow-hidden flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2">Contact Info</h3>
                <a class="text-indigo-400 hover:text-indigo-300" href="mailto:{{ $customer->email }}">{{ $customer->email }}</a><br>
                <span class="text-gray-300">{{ $customer->phone }}</span>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2">Billing Address</h3>
                <p class="text-gray-300">
                    {{ $customer->company_name }}<br>
                    {{ $customer->street_address }}<br>
                    {{ $customer->city }}, {{ $customer->state }} {{ $customer->zip }}<br>
                </p>
            </div>
        </section>




        <section class="mt-10">

            <div class="flex justify-between">
                <h2 class="text-3xl font-bold text-gray-100">
                    Customer Invoices
                </h2>
                <a
                    {{-- Notice the addition in the route below.
                    The invoices.create route needs the customer query in the url.
                    The associative array I added generates that query string automatically--}}
                    href="{{ route('invoices.create', ['customer' => $customer->id]) }}"
                    class="bg-violet-900 font-bold rounded p-2 text-white hover:bg-violet-700 cursor-pointer"
                >
                    Create New Invoice
                </a>
            </div>

            <div class="flex gap-5">
                <h3 class="text-2xl">Open invoices: {{ $customer->invoices->whereIn('status', ['sent', 'partially_paid', 'overdue'])->count() }}</h3>

                <h3 class="text-2xl">Total due: ${{ number_format($customer->invoices->sum('amount_due'), 2) }}</h3>
            </div>


        @if($customer->invoices->count())
            <table class="min-w-full bg-slate-800 border border-slate-700 my-6 rounded-md overflow-hidden shadow-md shadow-black/40">
                <thead class="bg-slate-700 text-left text-sm uppercase tracking-wider text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Invoice #</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">Amount</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Due Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                @foreach($customer->invoices as $invoice)
                    <tr class="hover:bg-slate-700/50 transition-colors cursor-pointer" onclick="window.location='{{ route('invoices.show', $invoice) }}'">
                        <td class="px-6 py-4 text-indigo-400 font-medium">{{ $invoice->invoice_number }}</td>
                        <td class="px-6 py-4 text-gray-300">{{ $invoice->description }}</td>
                        <td class="px-6 py-4 text-gray-300">${{ number_format($invoice->amount_due, 2) }}</td>
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
                        <td class="px-6 py-4 text-gray-300">{{ \Carbon\Carbon::parse($invoice->due_date)->format('M j, Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </section>

    </div>
</x-layout>
