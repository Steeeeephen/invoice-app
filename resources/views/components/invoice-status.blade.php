{{-- I realized I was using these status tags in a number of different places, and this seemed like a good method to not have to keep copying this code everywhere --}}
{{-- More on match expressions https://www.php.net/manual/en/control-structures.match.php --}}

@php
    // This is a bit new to me, but here's how I'm conditionally rendering styles to the different invoice status types.
    // Here's a match flow expression that matches the invoice status with some tailwind classes
    // and returns the corresponding Tailwind classes when a match is found.
    // The default arm acts as a fallback if no conditions match.
    $statusClasses = match ($status) {
        "paid" => "bg-green-500/20 text-green-400 border border-green-500/30",
        "overdue" => "bg-red-500/20 text-red-400 border border-red-500/30",
        "sent" => "bg-blue-500/20 text-blue-400 border border-blue-500/30",
        default => "bg-yellow-500/20 text-yellow-400 border border-yellow-500/30",
    };
@endphp

<span class="px-2 py-1 rounded-full font-semibold {{ $statusClasses }}">
    {{ ucfirst($status) }}
</span>
