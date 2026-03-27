<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl heading-font text-indigo-950 dark:text-white leading-tight tracking-tight">
            {{ __('Manual Payroll Entry') }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-0">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl sm:rounded-[2.5rem] overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-8 border-b border-gray-50 dark:border-gray-700 bg-indigo-50/30">
                    <h3 class="text-xl font-black text-indigo-900 dark:text-white mb-1 uppercase tracking-tighter">New Entry</h3>
                    <p class="text-indigo-600 font-medium text-sm">Select an employee to automatically fetch their basic salary.</p>
                </div>
                
                <form action="{{ route('payrolls.store') }}" method="POST" class="p-8 space-y-8">
                    @csrf

                    <div class="space-y-2">
                        <x-input-label for="employee_id" :value="__('Select Staff Member')" class="font-bold text-gray-700 ml-1" />
                        <select id="employee_id" name="employee_id"
                            class="block w-full border-gray-100 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all py-4 px-6"
                            required onchange="updateSalary()">
                            <option value="">Choose an employee...</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" data-salary="{{ $employee->salary }}">
                                    {{ $employee->first_name }} {{ $employee->last_name }} — {{ $employee->designation }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <x-input-label for="month" :value="__('Payroll Period (Month)')" class="font-bold text-gray-700 ml-1" />
                            <x-text-input id="month" class="block w-full" type="month" name="month"
                                :value="old('month', date('Y-m'))" required />
                            <x-input-error :messages="$errors->get('month')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="basic_salary" :value="__('Basic Salary (₹)')" class="font-bold text-gray-700 ml-1" />
                            <x-text-input id="basic_salary" class="block w-full" type="number" step="0.01"
                                name="basic_salary" :value="old('basic_salary')" required />
                            <x-input-error :messages="$errors->get('basic_salary')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <x-input-label for="allowances" :value="__('Total Allowances (₹)')" class="font-bold text-gray-700 ml-1" />
                            <x-text-input id="allowances" class="block w-full" type="number" step="0.01"
                                name="allowances" :value="old('allowances', 0)" />
                            <x-input-error :messages="$errors->get('allowances')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="deductions" :value="__('Total Deductions (₹)')" class="font-bold text-gray-700 ml-1" />
                            <x-text-input id="deductions" class="block w-full" type="number" step="0.01"
                                name="deductions" :value="old('deductions', 0)" />
                            <x-input-error :messages="$errors->get('deductions')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-6 pt-4 border-t border-gray-50 mt-12">
                        <a href="{{ route('payrolls.index') }}"
                            class="text-sm font-bold text-gray-500 hover:text-gray-900 transition underline underline-offset-4">Back to List</a>
                        <x-primary-button>
                            {{ __('Process & Save') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateSalary() {
            const select = document.getElementById('employee_id');
            const salaryInput = document.getElementById('basic_salary');
            if (!select || !salaryInput) return;
            
            const selectedOption = select.options[select.selectedIndex];
            const salary = selectedOption.getAttribute('data-salary');
            if (salary) {
                salaryInput.value = salary;
            }
        }
    </script>
</x-app-layout>