<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body class="bg-slate-400 text-gray-900 h-screen flex flex-col">

<nav class="bg-white shadow-md border-b border-gray-200">
    <div class="flex justify-between items-center px-6 py-4 max-w-7xl mx-auto">

        <a href="/" class="text-xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
            ICM App
        </a>

        {{--      Nav Links      --}}
        <ul class="flex flex-row gap-6">
            <li>
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Users
                </a>
            </li>
            <li>
                <a href="{{ route('customers.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Customers
                </a>
            </li>
            <li>
                <a href="{{ route('invoices.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Invoices
                </a>
            </li>
            <li>
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                    Projects
                </a>
            </li>
        </ul>

        {{--      Account Actions      --}}
        <ul class="flex flex-row">
            <li>
{{--                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">--}}
{{--                    Log In--}}
{{--                </a>--}}




            </li>
        </ul>

    </div>
</nav>




    @php
    $flashTypes = [
        'success' => 'bg-green-500'
    ]
    @endphp


<div class="max-w-3xl mx-auto mt-4 ">
    @foreach($flashTypes as $type => $bgClass)
        @if (session( $type ))
            <div class="{{ $bgClass }}" id="flash"> {{ session($type) }} </div>
        @endif
    @endforeach
</div>



    {{ $slot }}



<script>
    const flash = document.getElementById('flash');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transition = 'opacity 0.5s ease-out';
            setTimeout(() => flash.remove(), 500); // wait for transition
        }, 3000); // disappears after 3s
    }

</script>

</body>
</html>
