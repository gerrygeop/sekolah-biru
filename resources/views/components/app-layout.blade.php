<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {!! SEO::generate() !!}

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">S</span>
                    </div>
                    <div class="hidden sm:block">
                        <div class="font-bold text-lg text-gray-900">SMP Digital</div>
                        <div class="text-xs text-gray-500">Unggul & Berkarakter</div>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 transition">
                        Beranda
                    </a>

                    <!-- Profil Dropdown -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button
                            class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 transition flex items-center">
                            Profil
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                            <a href="{{ route('profile.vision-mission') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Visi & Misi</a>
                            <a href="{{ route('profile.organization') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Struktur Organisasi</a>
                            <a href="{{ route('profile.staff') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Tenaga Pendidik</a>
                            <a href="{{ route('profile.facilities') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Fasilitas</a>
                            <a href="{{ route('profile.students') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Data Siswa</a>
                        </div>
                    </div>

                    <!-- Lulusan Dropdown -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button
                            class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 transition flex items-center">
                            Lulusan
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                            <a href="{{ route('graduates.achievements') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Prestasi</a>
                            <a href="{{ route('graduates.alumni-distribution') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Sebaran Alumni</a>
                            <a href="{{ route('graduates.alumni') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Data Alumni</a>
                        </div>
                    </div>

                    <a href="{{ route('virtual-class.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 transition">
                        Kelas Virtual
                    </a>

                    <!-- Galeri Dropdown -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button
                            class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 transition flex items-center">
                            Galeri
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                            <a href="{{ route('gallery.photos') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Foto</a>
                            <a href="{{ route('gallery.videos') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Video</a>
                        </div>
                    </div>

                    <a href="{{ route('news.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 transition">
                        Berita
                    </a>

                    <a href="{{ route('contact') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 transition">
                        Kontak
                    </a>
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            class="lg:hidden border-t border-gray-200 bg-white">
            <div class="container mx-auto px-4 py-4 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Beranda</a>

                <!-- Mobile Profil -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Profil
                        <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" class="pl-4 space-y-1 mt-1">
                        <a href="{{ route('profile.vision-mission') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Visi & Misi</a>
                        <a href="{{ route('profile.organization') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Struktur
                            Organisasi</a>
                        <a href="{{ route('profile.staff') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Tenaga
                            Pendidik</a>
                        <a href="{{ route('profile.facilities') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Fasilitas</a>
                        <a href="{{ route('profile.students') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Data Siswa</a>
                    </div>
                </div>

                <!-- Mobile Lulusan -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Lulusan
                        <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" class="pl-4 space-y-1 mt-1">
                        <a href="{{ route('graduates.achievements') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Prestasi</a>
                        <a href="{{ route('graduates.alumni-distribution') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Sebaran Alumni</a>
                        <a href="{{ route('graduates.alumni') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Data Alumni</a>
                    </div>
                </div>

                <a href="{{ route('virtual-class.index') }}"
                    class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Kelas
                    Virtual</a>

                <!-- Mobile Galeri -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Galeri
                        <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" class="pl-4 space-y-1 mt-1">
                        <a href="{{ route('gallery.photos') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Foto</a>
                        <a href="{{ route('gallery.videos') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg">Video</a>
                    </div>
                </div>

                <a href="{{ route('news.index') }}"
                    class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Berita</a>
                <a href="{{ route('contact') }}"
                    class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Kontak</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- School Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">S</span>
                        </div>
                        <div>
                            <div class="font-bold text-white">SMP Digital</div>
                            <div class="text-xs text-gray-400">Unggul & Berkarakter</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400">
                        Menjadi sekolah unggul dalam prestasi dan berkarakter, mengembangkan potensi siswa secara
                        optimal.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold text-white mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('profile.vision-mission') }}"
                                class="hover:text-primary-400 transition">Visi & Misi</a></li>
                        <li><a href="{{ route('profile.staff') }}" class="hover:text-primary-400 transition">Tenaga
                                Pendidik</a></li>
                        <li><a href="{{ route('graduates.achievements') }}"
                                class="hover:text-primary-400 transition">Prestasi</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-primary-400 transition">Berita</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-semibold text-white mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Pendidikan No. 123, Kota</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>info@smpdigital.sch.id</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(021) 1234-5678</span>
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="font-semibold text-white mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} SMP Digital. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                mobileMenuOpen: false
            }))
        })
    </script>
</body>

</html>