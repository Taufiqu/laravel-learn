<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                {{-- Dynamic Header based on Role --}}
                @if($role)
                    @php
                        $roleConfig = [
                            'admin' => ['title' => 'Login Administrator', 'color' => 'text-red-600', 'bg' => 'bg-red-100'],
                            'guru' => ['title' => 'Login Guru', 'color' => 'text-green-600', 'bg' => 'bg-green-100'],
                            'siswa' => ['title' => 'Login Siswa', 'color' => 'text-blue-600', 'bg' => 'bg-blue-100']
                        ];
                        $config = $roleConfig[$role] ?? ['title' => 'Login', 'color' => 'text-gray-600', 'bg' => 'bg-gray-100'];
                    @endphp
                    
                    <div class="text-center">
                        <div class="mx-auto h-16 w-16 {{ $config['bg'] }} rounded-full flex items-center justify-center">
                            <div class="h-8 w-8 {{ $config['color'] }}">
                                @if($role === 'admin')
                                    <!-- Admin Icon -->
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                                    </svg>
                                @elseif($role === 'guru')
                                    <!-- Teacher Icon -->
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @else
                                    <!-- Student Icon -->
                                    <svg fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
                            {{ $config['title'] }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600">
                            Masukkan kredensial {{ $role }} Anda
                        </p>
                    </div>
                @else
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-gray-900">Login</h2>
                        <p class="mt-2 text-sm text-gray-600">Masuk ke akun Anda</p>
                    </div>
                @endif
            </div>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('login.store', ['role' => $role]) }}">
                @csrf

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Email address" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Password">
                    </div>
                </div>

                {{-- Display Validation Errors --}}
                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Terjadi kesalahan:
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>

                {{-- Navigation Links --}}
                <div class="text-center space-y-4">
                    <!-- Register Link -->
                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register', ['role' => $role]) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Daftar sekarang
                        </a>
                    </p>
                    
                    <!-- Role Navigation -->
                    <div class="border-t pt-4">
                        <p class="text-sm font-medium text-gray-700 mb-3">Atau login sebagai:</p>
                        <div class="grid grid-cols-3 gap-2">
                            @php
                                $roleNavigations = [
                                    'admin' => [
                                        'title' => 'Admin',
                                        'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                                        'color' => 'red',
                                        'bg' => $role === 'admin' ? 'bg-red-100 border-red-300' : 'bg-gray-50 hover:bg-red-50'
                                    ],
                                    'guru' => [
                                        'title' => 'Guru',
                                        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                                        'color' => 'green',
                                        'bg' => $role === 'guru' ? 'bg-green-100 border-green-300' : 'bg-gray-50 hover:bg-green-50'
                                    ],
                                    'siswa' => [
                                        'title' => 'Siswa',
                                        'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
                                        'color' => 'blue',
                                        'bg' => $role === 'siswa' ? 'bg-blue-100 border-blue-300' : 'bg-gray-50 hover:bg-blue-50'
                                    ]
                                ];
                            @endphp

                            @foreach($roleNavigations as $roleKey => $config)
                                @if($role !== $roleKey)
                                    <a href="{{ route('login', ['role' => $roleKey]) }}" 
                                       class="flex flex-col items-center p-3 border border-gray-200 rounded-lg {{ $config['bg'] }} transition-all duration-200 hover:shadow-sm">
                                        <svg class="w-5 h-5 mb-1 @if($config['color'] === 'red') text-red-600 @elseif($config['color'] === 'green') text-green-600 @else text-blue-600 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                                        </svg>
                                        <span class="text-xs font-medium @if($config['color'] === 'red') text-red-800 @elseif($config['color'] === 'green') text-green-800 @else text-blue-800 @endif">{{ $config['title'] }}</span>
                                    </a>
                                @else
                                    <div class="flex flex-col items-center p-3 border-2 {{ $config['bg'] }} rounded-lg">
                                        <svg class="w-5 h-5 mb-1 @if($config['color'] === 'red') text-red-600 @elseif($config['color'] === 'green') text-green-600 @else text-blue-600 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                                        </svg>
                                        <span class="text-xs font-bold @if($config['color'] === 'red') text-red-800 @elseif($config['color'] === 'green') text-green-800 @else text-blue-800 @endif">{{ $config['title'] }}</span>
                                        <span class="text-xs @if($config['color'] === 'red') text-red-600 @elseif($config['color'] === 'green') text-green-600 @else text-blue-600 @endif">Aktif</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        
                        <!-- Back to Home Link -->
                        <div class="mt-4">
                            <a href="{{ route('login') }}" class="text-xs text-gray-500 hover:text-gray-700 underline">
                                ← Kembali ke halaman utama
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>