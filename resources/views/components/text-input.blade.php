@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:bg-white dark:focus:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl shadow-sm transition-all py-4 px-6 dark:text-gray-300']) }}>