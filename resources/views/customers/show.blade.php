<x-layout>

    <h1 class="text-2xl font-bold">
        Customer Details
    </h1>

    <section class="min-w-full bg-gray-100 my-6 p-3 shadow-md rounded-md overflow-hidden">
        <div>
            <h2 class="text-xl font-semibold">{{ $customer->first_name }} {{ $customer->last_name }}</h2>
            <p>
                {{ $customer->company_name }}<br>
                {{ $customer->street_address }}<br>
                {{ $customer->city }}, {{ $customer->state }} {{ $customer->zip }}<br>
                {{ $customer->phone }}<br>
                <a class="text-blue-700" href="mailto:{{ $customer->email }}">{{ $customer->email }}</a><br>

            </p>
        </div>
    </section>

    <h1 class="text-2xl font-bold">
        Customer Invoices
    </h1>

        @if($customer->invoices->count())
            <table class="min-w-full bg-gray-100  rounded-md overflow-hidden shadow-md shadow-zinc-500/50">
                <thead class="bg-gray-200  text-left text-sm uppercase tracking-wider text-gray-800 ">
                <tr>
                    <th class="px-6 py-3" >Invoice #</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Amount</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Due Date</th>
                </tr>
                </thead>
                <tbody class="">
                    @foreach($customer->invoices as $invoice)
                        <tr>
                            <td class="px-6 py-4"><h1>{{ $invoice->invoice_number}}</h1></td>
                            <td class="px-6 py-4">{{ $invoice->description }}</td>
                            <td class="px-6 py-4">{{ $invoice->amount_due }}</td>
                            <td class="px-6 py-4">{{ $invoice->status }}</td>
                            <td class="px-6 py-4">{{ $invoice->due_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    @endif

</x-layout>
