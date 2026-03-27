<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center relative z-10 gap-4">
            <div>
                <h2 class="font-black text-3xl heading-font text-indigo-950 dark:text-white leading-tight">
                    {{ __('Payroll Management') }}
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 font-medium">Generate, review, and manage employee salaries.</p>
            </div>
            <div class="flex gap-4 w-full md:w-auto">
                <form action="{{ route('payrolls.generate') }}" method="POST" class="flex-1 md:flex-none flex gap-2">
                    @csrf
                    <input type="month" name="month" value="{{ date('Y-m') }}" 
                        class="bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-emerald-500 focus:border-emerald-500 dark:text-white shadow-sm transition-all px-4 py-3">
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl text-sm font-bold transition-all shadow-xl shadow-emerald-500/30 hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Generate
                    </button>
                </form>
                <a href="{{ route('payrolls.create') }}" class="flex-1 md:flex-none bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl text-sm font-bold transition-all shadow-xl shadow-indigo-600/30 hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Manual Entry
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative z-0">
        <div class="max-w-[1800px] mx-auto sm:px-6 lg:px-12">
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 dark:bg-emerald-900/30 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 rounded-2xl shadow-sm flex items-center gap-3 font-semibold">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2.5rem] border border-gray-100 dark:border-gray-700 relative">
                <!-- Search & Filters -->
                <div class="p-8 border-b border-gray-100/50 dark:border-gray-700/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-slate-50/50 dark:bg-gray-900/50">
                    <h3 class="text-xl font-black heading-font text-gray-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                        Payroll Records
                    </h3>

                    <form action="{{ route('payrolls.index') }}" method="GET" class="w-full md:w-auto flex flex-wrap gap-3">
                        <div class="relative w-full md:w-72">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full pl-11 pr-4 py-3 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-indigo-500 focus:border-indigo-500 dark:text-white shadow-sm transition-all"
                                placeholder="Search employee...">
                        </div>
                        <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-black dark:bg-white dark:hover:bg-gray-100 text-white dark:text-gray-900 rounded-2xl font-bold text-sm shadow-xl shadow-gray-900/20 dark:shadow-white/20 transition-all hover:-translate-y-1 active:scale-95">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('payrolls.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-2xl font-bold text-sm transition-all shadow-sm">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                        <thead class="bg-gray-50/30 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-8 py-5 text-left text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Employee</th>
                                <th class="px-8 py-5 text-left text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Month</th>
                                <th class="px-8 py-5 text-left text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Basic</th>
                                <th class="px-8 py-5 text-left text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Net Salary</th>
                                <th class="px-8 py-5 text-center text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Status</th>
                                <th class="px-8 py-5 text-right text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-50 dark:divide-gray-700/50">
                            @forelse($payrolls as $payroll)
                                <tr class="hover:bg-indigo-50/30 dark:hover:bg-gray-700/30 transition-colors group">
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 border border-white dark:border-gray-700 shadow flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-black text-sm group-hover:scale-110 transition-transform">
                                                {{ substr($payroll->employee->first_name, 0, 1) }}{{ substr($payroll->employee->last_name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-black text-gray-900 dark:text-white">{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</div>
                                                <div class="text-xs font-medium text-gray-500">{{ $payroll->employee->designation ?? 'Employee' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg text-sm font-bold border border-gray-200 dark:border-gray-600">
                                            {{ \Carbon\Carbon::parse($payroll->month)->format('M Y') }}
                                            @php
                                                // If month has no day, parsing as M Y is sufficient, e.g. "2026-03" -> "Mar 2026"
                                            @endphp
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-400">
                                        ₹{{ number_format($payroll->basic_salary, 2) }}
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm font-black text-gray-900 dark:text-white drop-shadow-sm">
                                        ₹{{ number_format($payroll->net_salary, 2) }}
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap text-center">
                                        @if($payroll->status == 'paid')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-black uppercase tracking-wider rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-400 dark:border-emerald-800">
                                                Paid
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-black uppercase tracking-wider rounded-xl bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-900/30 dark:text-amber-400 dark:border-amber-800">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2 items-center">
                                            @if($payroll->status == 'pending')
                                                <form action="{{ route('payrolls.pay', $payroll) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-3 py-1.5 bg-emerald-100 hover:bg-emerald-200 dark:bg-emerald-900/50 dark:hover:bg-emerald-800 text-emerald-700 dark:text-emerald-300 rounded-lg font-bold text-xs transition-colors shadow-sm border border-emerald-200 dark:border-emerald-700 mr-2" title="Mark Paid">
                                                        $ Pay
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <a href="{{ route('payrolls.show', $payroll) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-900/50 rounded-xl transition-colors" title="View Payslip">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            </a>
                                            <a href="{{ route('payrolls.edit', $payroll) }}" class="p-2 text-amber-600 hover:bg-amber-50 dark:text-amber-400 dark:hover:bg-amber-900/50 rounded-xl transition-colors" title="Edit Record">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </a>
                                            <form action="{{ route('payrolls.destroy', $payroll) }}" method="POST" onsubmit="return confirm('Ensure this payroll record is no longer needed. Proceed?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/50 rounded-xl transition-colors" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-12 text-center text-gray-500 dark:text-gray-400 font-medium">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            <p class="text-lg text-gray-800 dark:text-gray-300 font-bold">No payroll records found.</p>
                                            <p class="text-sm mt-1">Generate payrolls for the month or add them manually.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($payrolls->hasPages())
                    <div class="px-8 py-6 border-t border-gray-100/50 dark:border-gray-700/50 bg-slate-50/30 dark:bg-gray-900/30">
                        {{ $payrolls->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>