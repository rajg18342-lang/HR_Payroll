<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-2xl font-black text-sm text-white uppercase tracking-widest hover:bg-indigo-700 hover:-translate-y-0.5 shadow-xl shadow-indigo-600/30 active:scale-95 transition-all duration-200']) }}>
    {{ $slot }}
</button>