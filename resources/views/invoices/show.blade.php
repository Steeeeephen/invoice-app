<x-layout>
    <div class="flex flex-col container mx-auto px-6 py-6">
        {{--      Invoice Header      --}}
        <section
            class="flex justify-between items-center rounded-t-2xl bg-slate-700 p-2 shadow-md overflow-hidden"
        >
            <div class="flex items-center gap-2">
            <h1 class="text-6xl font-bold text-gray-100">
                {{ $invoice->invoice_number }}
            </h1>

            @can("update", $invoice)
                <a
                    href="{{ route("invoices.edit", $invoice->id) }}"
                    class="bg-purple-900 font-bold rounded text-white hover:bg-purple-700 transition-all ease-in cursor-pointer px-3 py-2 w-32 text-center"
                >
                    Edit
                </a>
            @endcan

            @can("send", $invoice)
                <form
                    action="{{ route("invoices.send", $invoice) }}"
                    method="POST"
                >
                    @csrf
                    @method("PATCH")
                    <button
                        class="bg-green-700 font-bold rounded text-white hover:bg-green-500 hover:text-gray-900 transition-all ease-in cursor-pointer px-4 py-2 w-32 text-center"
                        type="submit"
                    >
                        SEND
                    </button>
                </form>
            @endcan

                @can("pay", $invoice)
                    <a href="{{ route('invoices.payment-form', $invoice) }}"class="bg-green-700 font-bold rounded text-white hover:bg-green-500 hover:text-gray-900 transition-all ease-in cursor-pointer px-4 py-2 w-32 text-center"
                    >Payment
                    </a>
                @endcan

            </div>

            <div class="flex gap-4 items-center">


                <a href="{{ route('invoices.download', $invoice->id) }}"
                   class="bg-blue-700 font-bold rounded text-white hover:bg-blue-500 hover:text-gray-900 transition-all ease-in cursor-pointer px-4 py-2 w-32 text-center"

                >
                    Download
                </a>


                <h2 class="text-2xl m-0">
                    Status:
                    <x-invoice-status :status="$invoice->status"/>
                </h2>
            </div>
        </section>

        <div class="bg-slate-800 rounded-b-3xl">

            {{--      Customer Info      --}}
            <section
                class="min-w-full bg-slate-800 my-6 p-4  rounded-md overflow-hidden flex justify-between items-center"
            >
                <div>
                    <a href="{{ route('customers.show', $invoice->customer) }}"><h2
                            class="text-3xl text-slate-300 hover:text-white">{{$invoice->customer->first_name}} {{ $invoice->customer->last_name}}</h2>
                    </a>
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

            <hr class="border-slate-600">

            {{--      Invoice todal, and amount due      --}}
            <section
                class="min-w-full bg-slate-800 my-6 p-4  rounded-md overflow-hidden"
            >
                <div class="flex justify-between">
                    <h2 class="text-4xl">
                        Invoice total:
                        ${{ number_format($invoice->invoice_amount, 2, ".", ",") }}
                    </h2>
                    <h2 class="text-4xl">
                        Amount due:
                        ${{ number_format($invoice->amount_due, 2, ".", ",") }}
                    </h2>
                </div>
            </section>

            <hr class="border-slate-600">

            <section
                class="min-w-full bg-slate-800  my-6 p-4 rounded-md overflow-hidden"
            >
                <h3
                    class="text-lg font-semibold text-gray-400 uppercase tracking-wider mb-2"
                >
                    Description
                </h3>
                <p>{{ $invoice->description }}</p>
            </section>
        </div>
    </div>
</x-layout>
