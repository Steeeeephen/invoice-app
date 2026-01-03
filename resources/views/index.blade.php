<x-layout>

    <main class="flex justify-center items-center container mx-auto px-6 py-6 h-9/12">

        <form class="flex flex-col justify-around bg-slate-700 rounded p-4 h-9/12 shadow-zinc-100 shadow-2xl" action="">
            @csrf

            <h2 class="text-4xl text-zinc-50">Sign in to continue</h2>

            <div class="flex flex-col gap-4">

                <div class="flex flex-col">
                    <label class="text-zinc-50" for="email">Email</label>
                    <input class="bg-zinc-50 text-zinc-950 rounded text-2xl p-1" type="email" name="email" id="email">
                </div>


                <div class="flex flex-col">
                    <label class="text-zinc-50" for="password">Password</label>
                    <input class="bg-zinc-50 text-zinc-950 rounded text-2xl p-1" type="password" name="password" id="password">
                </div>


            </div>

            <button class="bg-blue-500 text-zinc-50 rounded p-1" type="submit">Log In</button>
        </form>

    </main>





</x-layout>
