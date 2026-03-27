<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HR_PAYROLL - Next-Gen Human Resource Management</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased text-gray-900 hero-gradient selection:bg-indigo-100 selection:text-indigo-900">
        <div class="relative min-h-screen overflow-hidden">
            <!-- Navigation -->
            <nav class="fixed top-0 w-full z-50 px-6 py-4">
                <div class="max-w-7xl mx-auto flex justify-between items-center glass border border-white/40 rounded-2xl px-6 py-3 shadow-xl shadow-indigo-500/5">
                    <div class="flex items-center gap-2">
                        <div class="h-10 w-10 bg-white rounded-xl flex items-center justify-center shadow-lg shadow-indigo-600/10 overflow-hidden border border-gray-100">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-full h-full object-cover">
                        </div>
                        <span class="text-2xl font-black heading-font tracking-tighter text-indigo-950">HR_PAYROLL</span>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition">Sign In</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-black transition shadow-lg shadow-indigo-600/20 active:scale-95">Start for Free</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="relative pt-32 pb-20 px-6 overflow-hidden">
                <div class="max-w-7xl mx-auto flex flex-col items-center text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 border border-indigo-100 mb-8 animate-bounce">
                        <span class="flex h-2 w-2 rounded-full bg-indigo-500"></span>
                        <span class="text-xs font-black text-indigo-600 uppercase tracking-widest">New: Automated Salary Generation</span>
                    </div>
                    
                    <h1 class="text-6xl md:text-8xl font-black heading-font tracking-tight text-indigo-950 leading-[0.9] mb-8">
                        The Operating System for <br>
                        <span class="gradient-text tracking-tighter">Human Capital.</span>
                    </h1>
                    
                    <p class="max-w-2xl text-xl text-gray-500 font-medium mb-12 leading-relaxed">
                        Automate your payroll, manage employees, and generate smart payslips in seconds. Built for speed, designed for clarity.
                    </p>
                    
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-lg font-black transition-all shadow-2xl shadow-indigo-600/40 hover:-translate-y-1 active:scale-95">
                            Get Started Now
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white hover:bg-gray-50 text-indigo-900 border border-indigo-100 rounded-2xl text-lg font-black transition-all shadow-xl shadow-indigo-500/5 hover:-translate-y-1 active:scale-95 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                            Explore Features
                        </a>
                    </div>

                    <!-- App Preview Mockup -->
                    <div class="mt-20 relative w-full max-w-5xl group">
                         <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                         <div class="relative bg-white dark:bg-gray-800 rounded-[2rem] shadow-2xl overflow-hidden border border-gray-100 p-2">
                             <div class="rounded-[1.5rem] overflow-hidden border border-gray-50">
                                 <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop" alt="Dashboard Preview" class="w-full h-auto">
                             </div>
                         </div>
                    </div>
                </div>
            </main>

            <!-- Features -->
            <section id="features" class="py-24 px-6 bg-white scroll-mt-24">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:shadow-2xl transition-all group">
                        <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black heading-font mb-4">Employee HUB</h3>
                        <p class="text-gray-500 font-medium">Keep your entire workforce organized with detailed profiles and smart tracking.</p>
                    </div>
                    
                    <div class="p-8 rounded-3xl bg-indigo-600 border border-indigo-700 shadow-2xl shadow-indigo-200 transform md:-translate-y-4 group">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-12 transition-transform">
                            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black heading-font mb-4 text-white">Smart Payroll</h3>
                        <p class="text-indigo-100 font-medium">Automated calculations for tax, allowances, and net salary. Zero room for error.</p>
                    </div>
                    
                    <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:shadow-2xl transition-all group">
                        <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black heading-font mb-4">Instant Slips</h3>
                        <p class="text-gray-500 font-medium">Generate beautiful, printable payslips for every employee with a single click.</p>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="py-12 border-t border-gray-100 text-center text-gray-400 font-medium text-sm">
                <p>&copy; 2026 HR_PAYROLL Management. Built with power & precision.</p>
            </footer>
        </div>
    </body>
</html>
