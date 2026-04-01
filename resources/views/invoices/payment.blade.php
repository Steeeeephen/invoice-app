<x-layout>
    <div class="flex  flex-col w-1/2 m-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-100">
            Processing payment for invoice: {{ $invoice->invoice_number }}
        </h1>

        <form action="{{ route('invoices.process-payment', $invoice) }}" method="POST">
            @csrf
            <div class="flex justify-between">
                <div class="flex flex-col justify-between">
                    <h2 class="text-2xl m-0">
                        Status:
                        <x-invoice-status :status="$invoice->status"/>
                    </h2>

                    <h2 class="block text-xl font-semibold text-gray-400 uppercase tracking-wider mb-1"
                    >Amount due: <br> {{ $invoice->amount_due }}</h2>
                </div>
                <div>

                    <label
                        for="payment_amount"
                        class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
                    >Payment Amount</label>

                    <input type="text"
                           id="payment_amount"
                           name="payment_amount"
                           class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                           placeholder="">

                    <button
                        type="submit"
                        class="bg-green-600 text-white text-sm mt-4 px-4 py-2 rounded hover:bg-green-500 cursor-pointer font-semibold"
                    >
                        Process Payment
                    </button>
                </div>


            </div>


        </form>
    </div>
</x-layout>
