<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl heading-font text-indigo-950 dark:text-white leading-tight">
            {{ __('Edit Employee Profile') }} <span class="text-indigo-500">—</span> {{ $employee->first_name }} {{ $employee->last_name }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-0">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2.5rem] border border-gray-100 dark:border-gray-700 p-8">
                <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                :value="old('first_name', $employee->first_name)" required autofocus />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                :value="old('last_name', $employee->last_name)" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $employee->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Phone Number')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $employee->phone)" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="department" :value="__('Department')" />
                            <x-text-input id="department" class="block mt-1 w-full" type="text" name="department"
                                :value="old('department', $employee->department)" />
                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="designation" :value="__('Designation')" />
                            <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation"
                                :value="old('designation', $employee->designation)" />
                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="join_date" :value="__('Joining Date')" />
                            <x-text-input id="join_date" class="block mt-1 w-full" type="date" name="join_date"
                                :value="old('join_date', $employee->join_date)" />
                            <x-input-error :messages="$errors->get('join_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="salary" :value="__('Base Salary (₹)')" />
                            <x-text-input id="salary" class="block mt-1 w-full" type="number" step="0.01" name="salary"
                                :value="old('salary', $employee->salary)" required />
                            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 gap-4">
                        <a href="{{ route('employees.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline">Cancel</a>
                        <x-primary-button>
                            {{ __('Update Employee') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>