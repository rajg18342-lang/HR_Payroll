<x-guest-layout>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50 relative overflow-hidden">
        
        <!-- Animated Background Blobs -->
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-indigo-200/30 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-purple-200/30 blur-[120px] rounded-full animate-pulse" style="animation-delay: 2s"></div>

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
                <h2 class="text-3xl font-black text-gray-900 heading-font mb-2">Welcome Back</h2>
                <p class="text-gray-500 font-medium">Log in to manage your human capital with precision.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-1.5 focus-within:scale-[1.02] transition-all">
                    <x-input-label for="email" :value="__('Work Email Address')" class="font-bold text-gray-700 ml-1 text-sm uppercase tracking-wider" />
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-indigo-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" /></svg>
                        </span>
                        <x-text-input id="email"
                            class="block w-full pl-12 bg-gray-50/50 border-gray-100 focus:bg-white transition-all rounded-2xl py-4"
                            type="email" name="email" :value="old('email')" required autofocus />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="space-y-1.5 focus-within:scale-[1.02] transition-all">
                    <div class="flex justify-between items-center px-1">
                        <x-input-label for="password" :value="__('Security Password')" class="font-bold text-gray-700 text-sm uppercase tracking-wider" />
                        @if (Route::has('password.request'))
                            <a class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot Credentials?') }}
                            </a>
                        @endif
                    </div>
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

                <!-- Remember Me & Extra -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox"
                            class="rounded-lg w-5 h-5 border-gray-200 text-indigo-600 shadow-sm focus:ring-indigo-500/20 transition cursor-pointer"
                            name="remember">
                        <span
                            class="ms-2 text-sm font-bold text-gray-500 group-hover:text-gray-700 transition">{{ __('Remember Session') }}</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4.5 rounded-2xl shadow-[0_15px_30px_rgba(79,70,229,0.3)] transition-all hover:-translate-y-1 active:scale-[0.98]">
                        {{ __('Authenticate to Portal') }}
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
                    <div class="relative flex justify-center text-xs uppercase"><span class="bg-white/80 px-4 text-gray-400 font-bold tracking-widest leading-none">Social Log In</span></div>
                </div>

                <!-- Social Login Buttons (from client's reference) -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="flex items-center justify-center gap-2 py-3 px-4 bg-white border border-gray-100 rounded-xl hover:bg-gray-50 transition font-bold text-sm text-gray-700 shadow-sm">
                        <svg class="w-5 h-5" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/><path fill="#FF3D00" d="m6.306 14.691 6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4c-7.539 0-14.129 4.161-17.694 10.691z"/><path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.414-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/><path fill="#1976D2" d="M43.611 20.083 43.595 20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/></svg>
                        Google
                    </button>
                    <button type="button" class="flex items-center justify-center gap-2 py-3 px-4 bg-white border border-gray-100 rounded-xl hover:bg-gray-50 transition font-bold text-sm text-gray-700 shadow-sm">
                        <svg class="w-5 h-5 text-gray-950" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.73.084-.73 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                        GitHub
                    </button>
                    <button type="button" class="col-span-2 flex items-center justify-center gap-2 py-3 px-4 bg-gray-950 text-white rounded-xl hover:bg-gray-800 transition font-bold text-sm shadow-sm mt-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.05 20.28c-.96.95-2.208 1.436-3.743 1.458-1.097 0-2.197-.442-3.3-1.326-1.103.884-2.203 1.326-3.3 1.326-1.557-.022-2.82-.508-3.79-1.458C1.943 19.33 1.455 18.077 1.455 16.52c0-3.109 1.46-5.592 4.38-7.448 1.557-.992 3.105-1.488 4.643-1.488 1-.002 1.36.19 1.905.576.443-.19.982-.375 1.617-.554.77-.208 1.432-.312 1.983-.312 1.093.003 2.193.313 3.3.93 2.204 1.24 3.306 2.89 3.306 4.962 0 1.56-.492 2.812-1.477 3.762zM12 5.066c-.473 0-.946-.07-1.42-.204 0-1.637.75-3.048 2.247-4.234a.6.6 0 01.123 0c.046 0 .093.002.137.002.476 0 .95.07 1.424.208 0 1.636-.75 3.047-2.246 4.234-.085.045-.17.07-.265.07z" /></svg>
                        Continue with Apple
                    </button>
                </div>

                <p class="text-center text-sm font-bold text-gray-500 pt-6">
                    New to the platform?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 transition-all border-b-2 border-indigo-100 hover:border-indigo-600 py-0.5">Create free account</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>