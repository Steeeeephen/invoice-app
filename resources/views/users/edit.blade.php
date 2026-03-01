<x-layout>
    <div class="flex justify-center items-center flex-col">
        @include(
            "users._form",
            [
                "action" => route("users.update", $user),
                "method" => "PUT",
                "buttonText" => "Update User",
                "title" => "Editing User",
            ]
        )
    </div>
</x-layout>
