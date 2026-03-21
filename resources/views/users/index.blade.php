<x-layout>

    {{--  This is the fixed modal for the delete confirmation  --}}
    <div
        class="fixed w-full h-screen rounded-xl bg-black/80 top-0 left-0 flex justify-center items-center overflow-hidden hidden"
        id="delete-modal">
        <div class="bg-slate-800 rounded-xl h-1/4 p-5 flex flex-col justify-around">
            <h1 class="text-2xl">
                Are you sure you want to delete this user?
            </h1>


            <div class="flex justify-center">
                <form action="" method="POST" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="bg-red-600 text-white text-sm px-4 py-2 rounded hover:bg-red-700 mr-6 cursor-pointer">
                        Yes, Delete
                    </button>
                </form>

                <button class="bg-zinc-50 border-red-600 text-black text-sm px-4 py-2 rounded hover:bg-zinc-200 mr-6 cursor-pointer"
                        id="close-delete-modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>


    <div class="flex flex-col container mx-auto px-6 py-6">
        <section class="flex items-center mb-4 justify-between">
            <h1 class="text-2xl font-bold mb-4">Admin List</h1>
            <a href="{{ route('users.create') }}"
               class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 mr-6">
                + Create User
            </a>
        </section>

        <table
            class="min-w-full bg-slate-800  my-6 rounded-md overflow-hidden shadow-md shadow-black/40">
            <thead class="bg-slate-700 text-left text-sm uppercase tracking-wider text-gray-400">
            <tr>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Email</th>
                <th class="px-6 py-3">Role</th>
                <th class="px-6 py-3"></th>

            </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
            @foreach ($users as $user)
                <tr class="hover:bg-slate-700/50 transition-colors cursor-pointer"
                    {{--                    onclick="window.location='{{ route('customers.show', $customer) }}'"--}}
                >
                    <td class="px-6 py-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->role }}</td>
                    <td class="px-6 py-4 text-right flex justify-end">
                        <a href="{{ route('users.edit', $user->id) }}">
                            <button
                                class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700 mr-6 cursor-pointer">
                                Edit
                            </button>
                        </a>


                        <button
                            data-user-id="{{ $user->id }}"
                            class="delete-btn bg-red-600 text-white text-sm px-4 py-2 rounded hover:bg-red-700 mr-6 cursor-pointer">
                            Delete
                        </button>


                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


</x-layout>
