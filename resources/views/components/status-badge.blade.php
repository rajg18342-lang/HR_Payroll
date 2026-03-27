@props(['status'])

@php
    $colors = match ($status) {
        'active', 'paid' => 'bg-emerald-50 text-emerald-700 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20',
        'inactive', 'pending' => 'bg-amber-50 text-amber-700 border-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20',
        'on_leave', 'draft' => 'bg-indigo-50 text-indigo-700 border-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:border-indigo-500/20',
        'terminated', 'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20',
        default => 'bg-gray-50 text-gray-700 border-gray-100 dark:bg-gray-500/10 dark:text-gray-400 dark:border-gray-500/20',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest border shadow-sm transition-all duration-300 hover:scale-105 $colors"]) }}>
    <span class="w-1.5 h-1.5 rounded-full mr-2 {{ str_replace(['bg-', 'text-', 'border-'], ['bg-current', '', ''], explode(' ', $colors)[0]) }}"></span>
    {{ str_replace('_', ' ', $status) }}
</span>
