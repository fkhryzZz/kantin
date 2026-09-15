@props(['status' => 'pending'])

@php
    $classes = [
        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
        'success' => 'bg-green-100 text-green-800 border-green-300',
        'failed' => 'bg-red-100 text-red-800 border-red-300',
    ][$status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $classes }}">
    {{ ucfirst($status) }}
</span>