<h1 class="text-2xl font-bold mb-6 text-gray-100">
    {{ $operation }} {{ $customer->first_name }} {{ $customer->last_name }}
</h1>

<form action="{{ $action }}" method="POST" class="w-1/2">
    @csrf
    @if ($method === "PUT")
        @method("PUT")
    @endif

    <div class="mb-4">
        <label
            for="invoice_amount"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            Invoice Amount
        </label>
        <input
            type="text"
            id="invoice_amount"
            name="invoice_amount"
            class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        />
    </div>

    <div class="mb-4">
        <label
            for="description"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            Description
        </label>
        <input
            type="text"
            id="description"
            name="description"
            class="w-full rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        />
    </div>

    <div class="mb-4">
        <label
            for="due_date"
            class="block text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1"
        >
            Due Date
        </label>
        <input
            type="date"
            name="due_date"
            id="due_date"
            class="rounded px-3 py-2 bg-slate-700 border border-slate-600 text-gray-100 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
        />
    </div>

    <input
        type="hidden"
        name="customer_id"
        value="{{ old("customer_id", $invoice->customer_id ?? ($customer->id ?? "")) }}"
    />

    <button
        type="submit"
        class="bg-indigo-600 text-white text-sm mt-4 px-4 py-2 rounded hover:bg-indigo-500 cursor-pointer font-semibold"
    >
        {{ $buttonText }}
    </button>
</form>
