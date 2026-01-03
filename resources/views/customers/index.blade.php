<x-layout>

    <main class="flex flex-col container mx-auto px-6 py-6">


    <div class="flex items-center mb-4 justify-between">
        <h1 class="text-2xl font-bold mb-4">Customer List</h1>
        <a href="{{ route('customers.create') }}"
           class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 mr-6">
            + Create Customer
        </a>
    </div>

    <table class="min-w-full bg-gray-100  shadow-md rounded-md overflow-hidden">
        <thead class="bg-gray-200  text-left text-sm uppercase tracking-wider text-gray-800 ">
        <tr>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Company</th>
            <th class="px-6 py-3">City</th>
            {{--            <th class="px-6 py-3">State</th>--}}
        </tr>
        </thead>
        <tbody class="text-sm text-gray-900 ">
        @foreach ($customers as $customer)
            <tr class="border-t border-gray-300  hover:bg-green-100  transition-colors">
                <td class="px-6 py-4">
                    <a href="{{ route('customers.show', $customer->id) }}"
                       class="text-blue-600 hover:underline dark:text-blue-400">
                        {{ $customer->first_name }} {{ $customer->last_name }}
                    </a>
                </td>
                <td class="px-6 py-4">{{ $customer->email }}</td>
                <td class="px-6 py-4">{{ $customer->company_name ?? '—' }}</td>
                <td class="px-6 py-4">{{ $customer->city }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    </main>


</x-layout>
