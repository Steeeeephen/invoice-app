<x-layout>

    <div class="flex flex-col container mx-auto px-6 py-6">
        <div class="flex justify-between items-center bg-slate-700 p-2 shadow-md rounded-md overflow-hidden">
            <h1 class="text-6xl font-bold text-gray-100">
                {{ $invoice->invoice_number  }}
            </h1>

            <h2 class="text-2xl">
                @php
                    $statusClasses = match($invoice->status) {
                        'paid'    => 'bg-green-500/20 text-green-400 border border-green-500/30',
                        'overdue' => 'bg-red-500/20 text-red-400 border border-red-500/30',
                        default   => 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30',
                    };
                @endphp
                 Status: <span class="px-2 py-1 rounded-full  font-semibold {{$statusClasses}}">{{ ucfirst($invoice->status) }}</span>
            </h2>
        </div>

        <section class="min-w-full bg-slate-800 border border-slate-700 my-6 p-4 shadow-md rounded-md overflow-hidden flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2">Contact Info</h3>
                <a class="text-indigo-400 hover:text-indigo-300" href="mailto:{{ $invoice->customer->email }}">{{ $invoice->customer->email }}</a><br>
                <span class="text-gray-300">{{ $invoice->customer->phone }}</span>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2">Billing Address</h3>
                <p class="text-gray-300">
                    {{ $invoice->customer->company_name }}<br>
                    {{ $invoice->customer->street_address }}<br>
                    {{ $invoice->customer->city }}, {{ $invoice->customer->state }} {{ $invoice->customer->zip }}<br>
                </p>
            </div>
        </section>

        <section class="min-w-full bg-slate-800 border border-slate-700 my-6 p-4 shadow-md rounded-md overflow-hidden">
            <h3 class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2">Description</h3>
            <p>{{ $invoice->description }}</p>
        </section>

        <section>
        </section>
    </div>


</x-layout>
