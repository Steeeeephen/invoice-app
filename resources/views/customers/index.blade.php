<x-layout>

    <div class="flex flex-col container mx-auto px-6 py-6">
        <section class="flex items-center mb-4 justify-between">
            <h1 class="text-2xl font-bold mb-4">Customer List</h1>
            <a href="{{ route('customers.create') }}"
               class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 mr-6">
                + Create Customer
            </a>
        </section>

        <table
            class="min-w-full bg-slate-800 border border-slate-700 my-6 rounded-md overflow-hidden shadow-md shadow-black/40">
        <thead class="bg-slate-700 text-left text-sm uppercase tracking-wider text-gray-400">
            <tr>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Email</th>
                <th class="px-6 py-3">Company</th>
                <th class="px-6 py-3">City</th>
                {{--            <th class="px-6 py-3">State</th>--}}
            </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
            @foreach ($customers as $customer)
                <tr class="hover:bg-slate-700/50 transition-colors cursor-pointer" onclick="window.location='{{ route('customers.show', $customer) }}'">
                    <td class="px-6 py-4">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    <td class="px-6 py-4">{{ $customer->email }}</td>
                    <td class="px-6 py-4">{{ $customer->company_name ?? '—' }}</td>
                    <td class="px-6 py-4">{{ $customer->city }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


</x-layout>
