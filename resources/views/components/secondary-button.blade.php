<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-8 py-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl font-black text-sm text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 hover:-translate-y-0.5 active:scale-95 transition-all duration-200']) }}>
    {{ $slot }}
</button>
