@section('title')
    Create a User
@endsection

<x-layout>
    <div class="flex justify-center items-center flex-col">
        @include(
            "users._form",
            [
                "title" => "Create a User",
                "action" => route("users.store"),
                "method" => "POST",
                "buttonText" => "Create User",
            ]
        )
    </div>
</x-layout>
