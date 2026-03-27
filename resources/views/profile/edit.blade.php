<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 dark:text-indigo-400 leading-tight tracking-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-0">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-12">
            <div
                class="p-8 sm:p-12 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl sm:rounded-[2.5rem] border border-gray-100 dark:border-gray-700">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div
                class="p-8 sm:p-12 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl sm:rounded-[2.5rem] border border-gray-100 dark:border-gray-700">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div
                class="p-8 sm:p-12 bg-rose-50/50 dark:bg-rose-950/20 backdrop-blur-xl border border-rose-100 dark:border-rose-900/30 sm:rounded-[2.5rem] shadow-2xl">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>