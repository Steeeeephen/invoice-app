<x-layout>
    <div class="flex flex-col container mx-auto px-6 py-6">
        <div
            class="flex justify-between items-center bg-slate-700 p-2 shadow-md rounded-md overflow-hidden"
        >
            <h1 class="text-6xl font-bold text-gray-100">
                {{ $invoice->invoice_number }}
            </h1>

            @can("update", $invoice)
                <a
                    href="{{ route("invoices.edit", $invoice->id) }}"
                    class="bg-violet-900 font-bold rounded p-2 text-white hover:bg-violet-700 cursor-pointer"
                >
                    Edit
                </a>
            @endcan

            @if ($invoice->status === "draft")
                <form
                    action="{{ route("invoices.send", $invoice) }}"
                    method="POST"
                >
                    @csrf
                    @method("PATCH")
                    <button
                        class="bg-violet-900 font-bold rounded p-2 text-white hover:bg-violet-700 cursor-pointer"
                        type="submit"
                    >
                        SEND
                    </button>
                </form>
            @endif

            <h2 class="text-2xl">

                Status:
                <x-invoice-status :status="$invoice->status"/>
            </h2>
        </div>

        <section
            class="min-w-full bg-slate-800 border border-slate-700 my-6 p-4 shadow-md rounded-md overflow-hidden flex justify-between"
        >
            <div>
                <h3
                    class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2"
                >
                    Contact Info
                </h3>
                <a
                    class="text-indigo-400 hover:text-indigo-300"
                    href="mailto:{{ $invoice->customer->email }}"
                >
                    {{ $invoice->customer->email }}
                </a>
                <br/>
                <span class="text-gray-300">
                    {{ $invoice->customer->phone }}
                </span>
            </div>

            <div>
                <h3
                    class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2"
                >
                    Billing Address
                </h3>
                <p class="text-gray-300">
                    {{ $invoice->customer->company_name }}
                    <br/>
                    {{ $invoice->customer->street_address }}
                    <br/>
                    {{ $invoice->customer->city }},
                    {{ $invoice->customer->state }}
                    {{ $invoice->customer->zip }}
                    <br/>
                </p>
            </div>
        </section>

        <section
            class="min-w-full bg-slate-800 border border-slate-700 my-6 p-4 shadow-md rounded-md overflow-hidden "
        >
            <div class="flex justify-between">
                <h1 class="text-4xl">
                    Invoice total:
                    ${{ number_format($invoice->invoice_amount, 2, ".", ",") }}
                </h1>
                <h1 class="text-4xl">
                    Amount due:
                    ${{ number_format($invoice->amount_due, 2, ".", ",") }}
                </h1>
            </div>

        </section>

        <section
            class="min-w-full bg-slate-800 border border-slate-700 my-6 p-4 shadow-md rounded-md overflow-hidden"
        >
            <h3
                class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2"
            >
                Description
            </h3>
            <p>{{ $invoice->description }}</p>
        </section>

        <section></section>
    </div>
</x-layout>
