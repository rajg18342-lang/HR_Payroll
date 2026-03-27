<x-guest-layout>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-purple-50 via-white to-indigo-50 relative overflow-hidden">
        
        <!-- Animated Background Blobs -->
        <div class="absolute -top-[10%] -right-[10%] w-[40%] h-[40%] bg-purple-200/30 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute -bottom-[10%] -left-[10%] w-[40%] h-[40%] bg-indigo-200/30 blur-[120px] rounded-full animate-pulse" style="animation-delay: 2.5s"></div>

        <div class="mb-8 flex flex-col items-center relative z-10 transition-all duration-700 hover:scale-110">
            <a href="/" class="flex items-center gap-3">
                <div
                    class="h-14 w-14 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-[0_15px_35px_rgba(79,70,229,0.3)] border border-indigo-400/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-4xl font-black tracking-tighter text-indigo-950 heading-font">HR_PAYROLL</span>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md px-10 py-12 bg-white/80 backdrop-blur-2xl shadow-[0_40px_100px_rgba(79,70,229,0.08)] border border-white/50 rounded-[3rem] relative z-10">
            
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-black text-gray-900 heading-font mb-2">Create Account</h2>
                <p class="text-gray-500 font-medium">Join the next generation of human resource management.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div class="space-y-1.5 focus-within:scale-[1.02] transition-all">
                    <x-input-label for="name" :value="__('Full Full Personnel Name')" class="font-bold text-gray-700 ml-1 text-sm uppercase tracking-wider" />
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-indigo-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" /></svg>
                        </span>
                        <x-text-input id="name"
                            class="block w-full pl-12 bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl py-4"
                            type="text" name="name" :value="old('name')" required autofocus />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email Address -->
                <div class="space-y-1.5 focus-within:scale-[1.02] transition-all">
                    <x-input-label for="email" :value="__('Work Corporate Email')" class="font-bold text-gray-700 ml-1 text-sm uppercase tracking-wider" />
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-indigo-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" /></svg>
                        </span>
                        <x-text-input id="email"
                            class="block w-full pl-12 bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl py-4"
                            type="email" name="email" :value="old('email')" required />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="space-y-1.5 focus-within:scale-[1.02] transition-all">
                    <x-input-label for="password" :value="__('Secure Access Password')" class="font-bold text-gray-700 ml-1 text-sm uppercase tracking-wider" />
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-indigo-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" /></svg>
                        </span>
                        <x-text-input id="password"
                            class="block w-full pl-12 bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl py-4"
                            type="password" name="password" required />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1.5 focus-within:scale-[1.02] transition-all">
                    <x-input-label for="password_confirmation" :value="__('Verify Secure Password')" class="font-bold text-gray-700 ml-1 text-sm uppercase tracking-wider" />
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-indigo-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-width="2" /></svg>
                        </span>
                        <x-text-input id="password_confirmation"
                            class="block w-full pl-12 bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl py-4"
                            type="password" name="password_confirmation" required />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4.5 rounded-2xl shadow-[0_15px_30px_rgba(79,70,229,0.3)] transition-all hover:-translate-y-1 active:scale-[0.98]">
                        {{ __('Register for Organization') }}
                    </button>
                </div>

                <p class="text-center text-sm font-bold text-gray-500 pt-4">
                    Already registered?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 transition-all border-b-2 border-indigo-100 hover:border-indigo-600 py-0.5">Sign in to portal</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>