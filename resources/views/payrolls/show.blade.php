<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center print:hidden">
            <h2 class="font-semibold text-2xl text-indigo-800 dark:text-indigo-400 leading-tight">
                {{ __('Salary Payslip') }} - {{ $payroll->month }}
            </h2>
            <button onclick="window.print()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl text-sm font-bold transition shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Payslip
            </button>
        </div>
    </x-slot>

    <div class="py-12 relative z-0">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl sm:rounded-[2.5rem] overflow-hidden border border-gray-100 dark:border-gray-700">
                <!-- Watermark / Branding -->
                <div class="p-12 border-b border-gray-100 dark:border-gray-700 bg-indigo-50 dark:bg-indigo-950/30">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1
                                class="text-4xl font-black gradient-text heading-font tracking-tighter uppercase leading-none">
                                HR_PAYROLL</h1>
                            <p class="text-gray-500 font-bold mt-2 uppercase text-xs tracking-widest">Official Salary Statement</p>
                        </div>
                        <div class="text-right">
                            <span
                                class="px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest {{ $payroll->status == 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $payroll->status }}
                            </span>
                            @if($payroll->payment_date)
                                <p class="text-xs text-gray-500 mt-2 font-mono">Paid on: {{ $payroll->payment_date }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-12">
                    <!-- Employee Info -->
                    <div class="grid grid-cols-2 gap-12 mb-12">
                        <div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Employee Details
                            </h4>
                            <div class="space-y-2">
                                <p class="text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</p>
                                <p class="text-gray-600 dark:text-gray-400 font-medium">
                                    {{ $payroll->employee->designation }}</p>
                                <p class="text-gray-500 text-sm font-mono">{{ $payroll->employee->department }}
                                    Department</p>
                                <p class="text-gray-500 text-sm italic">{{ $payroll->employee->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Statement Period
                            </h4>
                            <p class="text-3xl font-black text-indigo-600 dark:text-indigo-400">
                                {{ \Carbon\Carbon::parse($payroll->month)->format('F Y') }}</p>
                            <p class="text-gray-400 text-xs mt-1 font-mono uppercase tracking-tighter">REF:
                                PAY-{{ $payroll->id }}-{{ str_replace('-', '', $payroll->month) }}</p>
                        </div>
                    </div>

                    <!-- Salary Breakdown Table -->
                    <div class="border border-gray-100 dark:border-gray-700 rounded-2xl overflow-hidden mb-12">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-900">
                                    <th
                                        class="px-8 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">
                                        Earnings</th>
                                    <th
                                        class="px-8 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">
                                        Amount (₹)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                <tr>
                                    <td class="px-8 py-4 text-gray-700 dark:text-gray-300 font-medium tracking-tight">
                                        Basic Salary</td>
                                    <td class="px-8 py-4 text-right text-gray-900 dark:text-white font-mono">
                                        {{ number_format($payroll->basic_salary, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="px-8 py-4 text-gray-700 dark:text-gray-300 font-medium tracking-tight">
                                        House Rent & Other Allowances</td>
                                    <td class="px-8 py-4 text-right text-emerald-600 font-mono">
                                        +{{ number_format($payroll->allowances, 2) }}</td>
                                </tr>
                                <tr class="bg-rose-50/50 dark:bg-rose-950/10">
                                    <th
                                        class="px-8 py-4 text-left text-xs font-bold text-rose-400 uppercase tracking-widest border-t border-gray-100 dark:border-gray-700">
                                        Deductions</th>
                                    <th
                                        class="px-8 py-4 text-right text-xs font-bold text-rose-400 uppercase tracking-widest border-t border-gray-100 dark:border-gray-700">
                                    </th>
                                </tr>
                                <tr>
                                    <td
                                        class="px-8 py-4 text-rose-600 dark:text-rose-400 font-medium tracking-tight italic">
                                        Taxes & Insurance</td>
                                    <td class="px-8 py-4 text-right text-rose-600 font-mono">
                                        -{{ number_format($payroll->deductions, 2) }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-indigo-600 text-white">
                                    <td class="px-8 py-6 text-xl font-bold uppercase tracking-tighter">Net Payable
                                        Salary</td>
                                    <td class="px-8 py-6 text-right text-3xl font-black">
                                        ₹{{ number_format($payroll->net_salary, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Footer / Disclaimer -->
                    <div class="grid grid-cols-2 gap-8 items-end opacity-60">
                        <div class="text-xs text-gray-400">
                            <p class="font-bold mb-2 uppercase tracking-widest">Note:</p>
                            <p>This is a computer-generated document and does not require a physical signature. Any
                                discrepancies should be reported to the HR department within 7 business days.</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-indigo-400 font-mono mb-2 uppercase">Verified by System</p>
                            <div
                                class="h-12 w-32 bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800 rounded inline-flex items-center justify-center italic text-indigo-300">
                                HR_AUTOSIGN
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center print:hidden">
                <a href="{{ route('payrolls.index') }}"
                    class="text-indigo-600 hover:text-indigo-800 font-bold transition">← Back to Records</a>
            </div>
        </div>
    </div>
</x-app-layout>