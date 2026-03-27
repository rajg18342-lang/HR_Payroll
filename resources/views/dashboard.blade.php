<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center relative z-10">
            <div>
                <h2 class="font-black text-4xl heading-font text-indigo-950 dark:text-white leading-tight tracking-tighter">
                    {{ __('Analytics Command Center') }}
                </h2>
                <div class="flex items-center gap-2 mt-2">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-bold tracking-wide uppercase">System Operational • Live Dashboard</p>
                </div>
            </div>
            
            <div class="mt-4 md:mt-0 flex items-center gap-4">
                <div class="hidden lg:flex flex-col items-end mr-2">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Server Time</span>
                    <span class="text-sm font-bold text-indigo-950">{{ now()->format('H:i T') }}</span>
                </div>
                <div class="h-12 w-12 rounded-2xl bg-white border border-indigo-50 shadow-sm flex items-center justify-center text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-width="2"/></svg>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 relative overflow-hidden">
        <!-- Background Accents -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-100/40 blur-[150px] rounded-full -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-100/40 blur-[150px] rounded-full -ml-48 -mb-48"></div>

        <div class="max-w-[1800px] mx-auto sm:px-6 lg:px-12 relative z-10">
            
            <!-- Quick Command Toolbar -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-10 bg-white/40 backdrop-blur-xl p-4 rounded-[2.5rem] border border-white/60 shadow-xl shadow-indigo-100/20">
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('employees.create') }}" class="group flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-7 py-4 rounded-2xl font-black text-sm transition-all hover:scale-105 active:scale-95 shadow-lg shadow-indigo-600/20">
                        <div class="bg-white/20 p-1.5 rounded-lg group-hover:rotate-90 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        Onboard Talent
                    </a>
                    <a href="{{ route('payrolls.create') }}" class="flex items-center gap-3 bg-white text-indigo-900 border border-indigo-100/50 px-7 py-4 rounded-2xl font-black text-sm transition-all hover:scale-105 active:scale-95 shadow-sm hover:shadow-xl">
                        <div class="bg-indigo-50 p-1.5 rounded-lg text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2.5"/></svg>
                        </div>
                        Execute Payroll
                    </a>
                </div>
                
                <div class="flex items-center gap-4 pr-2">
                    <div class="hidden md:block">
                        <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest block text-right">Quick Statistics</span>
                        <div class="flex items-center gap-4 mt-1">
                            <div class="text-right border-r border-indigo-50 pr-4">
                                <p class="text-lg font-black text-indigo-950 leading-none">{{ $totalEmployees }}</p>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-tight mt-1">Staff Core</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-black text-emerald-600 leading-none">₹{{ number_format($totalPayrollThisMonth/1000, 1) }}K</p>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-tight mt-1">Monthly Burn</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Core Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- KPI 1 -->
                <div class="group bg-white/70 backdrop-blur-xl p-7 rounded-[2.5rem] border border-white/80 shadow-2xl shadow-indigo-100/20 transition-all hover:-translate-y-2">
                    <div class="flex justify-between items-start mb-6">
                        <div class="h-14 w-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-500">
                            <svg class="h-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <span class="text-emerald-500 bg-emerald-50 text-[10px] font-black px-2 py-1 rounded-lg uppercase tracking-wider">+12%</span>
                    </div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Human Capital</p>
                    <h4 class="text-3xl font-black text-indigo-950 tracking-tighter">{{ $totalEmployees }}</h4>
                </div>

                <!-- KPI 2 -->
                <div class="group bg-white/70 backdrop-blur-xl p-7 rounded-[2.5rem] border border-white/80 shadow-2xl shadow-indigo-100/20 transition-all hover:-translate-y-2">
                    <div class="flex justify-between items-start mb-6">
                        <div class="h-14 w-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-500">
                            <svg class="h-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
                        </div>
                        <span class="text-emerald-500 bg-emerald-50 text-[10px] font-black px-2 py-1 rounded-lg uppercase tracking-wider">Live</span>
                    </div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Monthly Payroll</p>
                    <h4 class="text-2xl font-black text-indigo-950 tracking-tighter truncate">₹{{ number_format($totalPayrollThisMonth) }}</h4>
                </div>

                <!-- KPI 3 -->
                <div class="group bg-white/70 backdrop-blur-xl p-7 rounded-[2.5rem] border border-white/80 shadow-2xl shadow-indigo-100/20 transition-all hover:-translate-y-2">
                    <div class="flex justify-between items-start mb-6">
                        <div class="h-14 w-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-500">
                            <svg class="h-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/></svg>
                        </div>
                        <span class="text-amber-500 bg-amber-50 text-[10px] font-black px-2 py-1 rounded-lg uppercase tracking-wider">{{ $pendingPayrolls }} Open</span>
                    </div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Pending Tasks</p>
                    <h4 class="text-3xl font-black text-indigo-950 tracking-tighter">{{ $pendingPayrolls }}</h4>
                </div>

                <!-- KPI 4: Dynamic Attendance Real Logic -->
                <div class="group bg-indigo-950 p-7 rounded-[2.5rem] shadow-2xl shadow-indigo-900/40 transition-all hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-10 text-white transform rotate-12">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                    </div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="h-12 w-12 bg-white/10 rounded-2xl flex items-center justify-center text-white">
                            <svg class="h-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2"/></svg>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-emerald-400 text-[10px] font-black uppercase tracking-widest">{{ $attendance['present'] }} Present</span>
                            <span class="text-rose-400 text-[9px] font-bold uppercase tracking-widest mt-0.5">{{ $attendance['leave'] }} Absentees</span>
                        </div>
                    </div>
                    <p class="text-xs font-black text-indigo-300 uppercase tracking-widest mb-1 relative z-10">System Attendance</p>
                    <div class="flex items-baseline gap-2 relative z-10">
                        <h4 class="text-3xl font-black text-white tracking-tighter">{{ $attendance['present'] }}</h4>
                        <span class="text-indigo-400 font-bold">/ {{ $totalEmployees }}</span>
                    </div>
                </div>
            </div>

            <!-- Visualization Layer -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                <!-- Chart: Main Volume -->
                <div class="lg:col-span-2 bg-white/70 backdrop-blur-xl p-10 rounded-[3rem] border border-white shadow-2xl shadow-indigo-100/10">
                    <div class="flex justify-between items-center mb-10">
                        <div>
                            <h3 class="text-2xl font-black text-indigo-950 tracking-tighter uppercase">Payroll Capital Volatility</h3>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mt-1">Operational disbursement trend • 6 Months</p>
                        </div>
                        <div class="flex gap-2">
                             <div class="h-10 w-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-indigo-600 transition-colors cursor-pointer"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg></div>
                        </div>
                    </div>
                    <div class="h-[350px]">
                        <canvas id="payrollChart"></canvas>
                    </div>
                </div>

                <!-- Snapshot: Side Panels -->
                <div class="flex flex-col gap-8">
                     <!-- Distribution Donut -->
                    <div class="flex-1 bg-white/70 backdrop-blur-xl p-8 rounded-[3rem] border border-white shadow-2xl shadow-indigo-100/10">
                        <h3 class="text-lg font-black text-indigo-950 uppercase tracking-widest mb-6">Staff Allocation</h3>
                        <div class="h-56 relative">
                            <canvas id="deptChart"></canvas>
                        </div>
                    </div>

                    <!-- Highlights Listing -->
                    <div class="flex-1 bg-indigo-600 p-8 rounded-[3rem] shadow-2xl shadow-indigo-600/30 text-white relative overflow-hidden">
                        <div class="absolute right-0 top-0 opacity-10 -rotate-12 translate-x-4 -translate-y-4">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h14v14H5V5zm3 3v2h2V8H8zm4 0v2h2V8h-2zm4 0v2h2V8h-2zM8 12v2h2v-2H8zm4 0v2h2v-2h-2zm4 0v2h2v-2h-2z"/></svg>
                        </div>
                        <h3 class="text-lg font-black uppercase tracking-widest mb-6 relative z-10">Network Highlights</h3>
                        <div class="space-y-4 relative z-10">
                            @foreach($upcomingHolidays as $holiday)
                                <div class="flex items-center gap-4 bg-white/10 p-3 rounded-2xl hover:bg-white/20 transition-all group">
                                    <div class="h-12 w-12 rounded-xl bg-white/20 flex flex-col items-center justify-center font-black group-hover:scale-110 transition-transform">
                                        <span class="text-[10px] uppercase">{{ $holiday['date']->format('M') }}</span>
                                        <span class="text-lg">{{ $holiday['date']->format('d') }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-sm truncate uppercase tracking-tight">{{ $holiday['name'] }}</p>
                                        <p class="text-[10px] font-black text-indigo-200 uppercase tracking-widest">Public Holiday</p>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($upcomingBirthdays as $emp)
                                <div class="flex items-center gap-4 bg-white p-3 rounded-2xl shadow-xl shadow-indigo-900/20 group animate-bounce-subtle">
                                    <div class="h-12 w-12 rounded-xl bg-indigo-50 flex items-center justify-center text-xl">🎂</div>
                                    <div class="min-w-0">
                                        <p class="font-black text-indigo-950 text-sm truncate uppercase tracking-tighter">{{ $emp->first_name }}'s Special Day</p>
                                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">
                                            @if($emp->days_until == 0) Happening Today! @else In {{ $emp->days_until }} Days @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personnel Master Directory -->
            <div class="bg-white/70 backdrop-blur-xl rounded-[3rem] border border-white shadow-2xl shadow-indigo-100/5 overflow-hidden">
                <div class="p-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h3 class="text-2xl font-black text-indigo-950 tracking-tighter uppercase">Personnel Master Ledger</h3>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mt-1">Direct access to staff core profiles</p>
                    </div>
                    <div class="flex items-center gap-3 w-full md:w-auto overflow-hidden">
                        <div class="relative flex-1 md:w-80 group">
                             <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="ENTER PERSONNEL NAME..." class="w-full bg-indigo-50/50 border-none rounded-[1.25rem] px-6 py-4 text-sm font-black focus:ring-2 focus:ring-indigo-600 placeholder:text-indigo-300 transition-all uppercase tracking-widest">
                             <svg class="w-5 h-5 text-indigo-400 absolute right-5 top-4 group-focus-within:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2.5"/></svg>
                        </div>
                        <a href="{{ route('employees.index') }}" class="bg-indigo-950 text-white p-4.5 rounded-[1.25rem] hover:bg-indigo-900 transition-colors shadow-lg shadow-indigo-950/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2.5"/></svg>
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-indigo-50/40 text-left">
                                <th class="px-10 py-5 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Personnel</th>
                                <th class="px-10 py-5 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Unit / Sector</th>
                                <th class="px-10 py-5 text-[10px] font-black text-indigo-400 uppercase tracking-widest border-x border-white">Classification</th>
                                <th class="px-10 py-5 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Network Status</th>
                                <th class="px-10 py-5 text-[10px] font-black text-indigo-400 uppercase tracking-widest text-right">Compensation</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-50/50">
                            @foreach($recentEmployees as $employee)
                                <tr class="hover:bg-indigo-50/20 transition-all duration-300 emp-row group">
                                    <td class="px-10 py-6 whitespace-nowrap emp-name">
                                        <div class="flex items-center gap-4">
                                            <div class="h-12 w-12 rounded-[1rem] bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center text-indigo-600 font-black shadow-sm group-hover:scale-110 transition-transform">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->first_name . ' ' . $employee->last_name) }}&background=EEF2FF&color=4F46E5&bold=true&rounded=false&length=2" alt="" class="rounded-xl w-full h-full opacity-90">
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-indigo-950 group-hover:text-indigo-600 transition tracking-tighter uppercase">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                                <p class="text-[10px] font-black text-indigo-300 uppercase tracking-widest mt-0.5">ID: #{{ str_pad($employee->id, 5, '0', STR_PAD_LEFT) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-10 py-6 whitespace-nowrap">
                                        <span class="text-xs font-bold text-gray-500 italic">{{ $employee->department }}</span>
                                    </td>
                                    <td class="px-10 py-6 whitespace-nowrap border-x border-white">
                                        <p class="text-xs font-black text-indigo-950 uppercase tracking-tighter">{{ $employee->designation }}</p>
                                    </td>
                                    <td class="px-10 py-6 whitespace-nowrap">
                                        @php
                                            $status = strtolower($employee->status ?? 'active');
                                            $stClass = match($status) {
                                                'active' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                'remote' => 'bg-sky-100 text-sky-700 border-sky-200',
                                                default  => 'bg-amber-100 text-amber-700 border-amber-200',
                                            };
                                        @endphp
                                        <span class="{{ $stClass }} px-3.5 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest border shadow-sm">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-6 whitespace-nowrap text-right">
                                        <p class="text-sm font-black text-indigo-950 tracking-tighter">₹{{ number_format($employee->salary, 2) }}</p>
                                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Base P.A.</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-10 py-8 bg-indigo-50/20 border-t border-indigo-50/40 flex justify-center">
                    <a href="{{ route('employees.index') }}" class="text-[10px] font-black text-indigo-400 hover:text-indigo-600 uppercase tracking-[0.25em] transition flex items-center gap-2">
                         EXPLORE FULL PERSONNEL DIRECTORY
                         <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Advanced Search Implementation
            function filterTable() {
                let input = document.getElementById("searchInput").value.toUpperCase();
                let table = document.querySelector("table");
                let trs = table.getElementsByClassName("emp-row");
                
                for (let i = 0; i < trs.length; i++) {
                    let td = trs[i].getElementsByClassName("emp-name")[0];
                    if (td) {
                        let txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(input) > -1) {
                            trs[i].style.display = "";
                            trs[i].style.opacity = "1";
                        } else {
                            trs[i].style.display = "none";
                        }
                    }
                }
            }

            // Global Chart Shadows/Styles
            Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
            Chart.defaults.font.weight = '700';
            Chart.defaults.color = '#94a3b8';

            // Payroll Capital Analysis
            const ctxPayroll = document.getElementById('payrollChart').getContext('2d');
            const gradient = ctxPayroll.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(79, 70, 229, 0.4)');
            gradient.addColorStop(1, 'rgba(79, 70, 229, 0.0)');

            new Chart(ctxPayroll, {
                type: 'line',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Net Outflow (₹)',
                        data: {!! json_encode($payrollData) !!},
                        borderColor: '#4f46e5',
                        backgroundColor: gradient,
                        borderWidth: 6,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#4f46e5',
                        pointBorderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e1b4b',
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
                            padding: 12,
                            borderRadius: 16,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(79, 70, 229, 0.05)', drawBorder: false },
                            ticks: { font: { size: 10, weight: '900' } }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { size: 10, weight: '900' } }
                        }
                    }
                }
            });

            // Allocation Sector Distribution
            const ctxDept = document.getElementById('deptChart').getContext('2d');
            new Chart(ctxDept, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($deptStats->pluck('department')) !!},
                    datasets: [{
                        data: {!! json_encode($deptStats->pluck('count')) !!},
                        backgroundColor: ['#4f46e5', '#7c3aed', '#ec4899', '#f59e0b', '#10b981'],
                        borderWidth: 0,
                        hoverOffset: 15,
                        borderRadius: 10,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, padding: 25, font: { size: 10 } } }
                    }
                }
            });
        </script>
        
        <style>
            @keyframes bounce-subtle {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-5px); }
            }
            .animate-bounce-subtle {
                animation: bounce-subtle 4s infinite ease-in-out;
            }
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    @endpush
</x-app-layout>