<div>
    <label for="invoice-status-select" class="text-xl">Filter Status: </label>
    <select
        name="invoice-status-select"
        id="invoice-status-select"
        class="bg-slate-800 rounded px-2 py-1"
    >
        <option value=""  selected>View All</option>
        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent</option>
        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="partially-paid" {{ request('status') === 'partially-paid' ? 'selected' : '' }}>Partially Paid</option>
        <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
        <option value="cancelled {{ request('status') === 'cancelled' ? 'selected' : '' }}">Cancelled</option>
    </select>
</div>
