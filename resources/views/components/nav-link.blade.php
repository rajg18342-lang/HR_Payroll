@props(['active'])

@php
$classes = ($active ?? false)
            ? 'px-4 py-2 rounded-xl font-bold transition-all duration-200 text-sm bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 shadow-sm border border-indigo-100 dark:border-indigo-800'
            : 'px-4 py-2 rounded-xl font-bold transition-all duration-200 text-sm text-gray-500 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200 hover:shadow-sm border border-transparent';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
