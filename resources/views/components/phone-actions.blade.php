@php
$phone = $record->phone_number;
$cleanPhone = preg_replace('/[^0-9]/', '', $phone);
@endphp

<div class="flex items-center justify-center gap-2">
    <a href="tel:{{ $phone }}"
        class="inline-flex items-center justify-center p-2 rounded-lg bg-blue-600 text-white hover:bg-blue-500 transition-colors duration-200"
        title="phone">
        <x-heroicon-o-phone style="color:#333" class="w-5 h-5" />
    </a>

    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank"
        class="inline-flex items-center justify-center p-2 rounded-lg bg-green-600 text-white hover:bg-green-500 transition-colors duration-200"
        title="wahtsapp">
        <x-heroicon-o-chat-bubble-left-ellipsis style="color:#39e738a1" class="w-5 h-5 text-green-500" />
    </a>
</div>