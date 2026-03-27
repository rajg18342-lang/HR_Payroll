<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl heading-font text-indigo-950 dark:text-white leading-tight tracking-tight">
            {{ __('Adjust Payroll Record') }}
        </h2>
    </x-slot>

    <div class="py-12 relative z-0">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl sm:rounded-[2.5rem] overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-8 border-b border-gray-50 dark:border-gray-700 bg-indigo-50/30">
                    <h3 class="text-xl font-black text-indigo-900 dark:text-white mb-1 uppercase tracking-tighter">
                        Adjust Statement</h3>
                    <p class="text-indigo-600 font-medium text-sm">Employee: {{ $payroll->employee->first_name }}
                        {{ $payroll->employee->last_name }} | Month: {{ $payroll->month }}</p>
                </div>

                <form action="{{ route('payrolls.update', $payroll) }}" method="POST" class="p-8 space-y-8">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <x-input-label for="basic_salary" :value="__('Basic Salary (₹)')"
                                class="font-bold text-gray-700 ml-1" />
                            <x-text-input id="basic_salary" class="block w-full" type="number" step="0.01"
                                name="basic_salary" :value="old('basic_salary', $payroll->basic_salary)" required />
                            <x-input-error :messages="$errors->get('basic_salary')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="status" :value="__('Status')" class="font-bold text-gray-700 ml-1" />
                            <select id="status" name="status"
                                class="block w-full border-gray-100 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all py-3 px-4">
                                <option value="pending" {{ $payroll->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="paid" {{ $payroll->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <x-input-label for="allowances" :value="__('Bonus / Allowances (₹)')"
                                class="font-bold text-gray-700 ml-1" />
                            <x-text-input id="allowances" class="block w-full" type="number" step="0.01"
                                name="allowances" :value="old('allowances', $payroll->allowances)" required />
                            <x-input-error :messages="$errors->get('allowances')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="deductions" :value="__('Reductions / Taxes (₹)')"
                                class="font-bold text-gray-700 ml-1" />
                            <x-text-input id="deductions" class="block w-full" type="number" step="0.01"
                                name="deductions" :value="old('deductions', $payroll->deductions)" required />
                            <x-input-error :messages="$errors->get('deductions')" class="mt-2" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="payment_date" :value="__('Payment Date')"
                            class="font-bold text-gray-700 ml-1" />
                        <x-text-input id="payment_date" class="block w-full" type="date" name="payment_date"
                            :value="old('payment_date', $payroll->payment_date)" />
                        <x-input-error :messages="$errors->get('payment_date')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-6 pt-4 border-t border-gray-50 mt-12">
                        <a href="{{ route('payrolls.index') }}"
                            class="text-sm font-bold text-gray-500 hover:text-gray-900 transition underline underline-offset-4">Cancel
                            Changes</a>
                        <x-primary-button>
                            {{ __('Apply Adjustments') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>