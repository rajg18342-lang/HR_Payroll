<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center relative z-10">
            <div>
                <h2 class="font-black text-3xl heading-font text-indigo-950 dark:text-white leading-tight">
                    {{ __('Employee Management') }}
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 font-medium">Manage your workforce, update profiles, and track details.</p>
            </div>
            <a href="{{ route('employees.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl text-sm font-bold transition-all shadow-xl shadow-indigo-600/30 hover:-translate-y-1 active:scale-95 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Employee
            </a>
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
                    <h3 class="text-xl font-black heading-font text-gray-900 dark:text-white uppercase tracking-wider">All Employees</h3>

                    <form action="{{ route('employees.index') }}" method="GET" class="w-full md:w-auto flex gap-3">
                        <div class="relative w-full md:w-72">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full pl-11 pr-4 py-3 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-indigo-500 focus:border-indigo-500 dark:text-white shadow-sm transition-all"
                                placeholder="Search employees...">
                        </div>
                        <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-black dark:bg-white dark:hover:bg-gray-100 text-white dark:text-gray-900 rounded-2xl font-bold text-sm shadow-xl shadow-gray-900/20 dark:shadow-white/20 transition-all hover:-translate-y-1 active:scale-95">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('employees.index') }}"
                                class="px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-2xl font-bold text-sm transition-all shadow-sm">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                        <thead class="bg-gray-50/30 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-8 py-5 text-left text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Name</th>
                                <th class="px-8 py-5 text-left text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Department</th>
                                <th class="px-8 py-5 text-left text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Designation</th>
                                <th class="px-8 py-5 text-right text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Salary</th>
                                <th class="px-8 py-5 text-right text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest heading-font">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-50 dark:divide-gray-700/50">
                            @forelse($employees as $employee)
                                <tr class="hover:bg-indigo-50/30 dark:hover:bg-gray-700/30 transition-colors group">
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/50 dark:to-purple-900/50 border border-white dark:border-gray-700 shadow-inner flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-black text-lg group-hover:scale-110 transition-transform">
                                                {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-black text-gray-900 dark:text-white">{{ $employee->first_name }} {{ $employee->last_name }}</div>
                                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $employee->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <span class="px-4 py-1.5 inline-flex text-xs leading-5 font-bold rounded-xl {{ $employee->department ? 'bg-purple-50 text-purple-700 border border-purple-100 dark:bg-purple-900/30 dark:text-purple-400 dark:border-purple-800' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">
                                            {{ $employee->department ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm font-semibold text-gray-600 dark:text-gray-300">
                                        {{ $employee->designation ?? 'N/A' }}
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm font-black text-gray-900 dark:text-white text-right">
                                        ₹{{ number_format($employee->salary, 2) }}
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('employees.edit', $employee) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-900/50 rounded-xl transition-colors" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');" class="inline">
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
                                    <td colspan="5" class="px-8 py-12 text-center text-gray-500 dark:text-gray-400 font-medium">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            <p class="text-lg text-gray-800 dark:text-gray-300 font-bold">No employees found.</p>
                                            <p class="text-sm mt-1">Get started by adding a new employee to your database.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($employees->hasPages())
                    <div class="px-8 py-6 border-t border-gray-100/50 dark:border-gray-700/50 bg-slate-50/30 dark:bg-gray-900/30">
                        {{ $employees->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>