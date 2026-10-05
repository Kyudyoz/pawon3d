<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta name="color-scheme" content="light">
    @include('partials.head')
    {{-- Preload LCP hero image --}}
    @if (!empty($storeProfile->banner))
        <link rel="preload" as="image" href="{{ asset('storage/' . $storeProfile->banner) }}">
    @else
        <link rel="preload" as="image" href="{{ asset('img/apem.webp') }}" type="image/webp">
    @endif
    <style>
        html {
            scroll-behavior: smooth;
        }

        .montserrat-regular {
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .pacifico-regular {
            font-family: "Pacifico", cursive;
            font-weight: 500;
            font-style: normal;
        }
    </style>

    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Bakery",
      "name": "{{ $storeProfile->name ?? 'Pawon3D' }}",
      "image": "{{ !empty($storeProfile->logo) ? asset('storage/' . $storeProfile->logo) : asset('assets/bakery-logo.png') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": "{{ $storeProfile->contact ?? '' }}",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ $storeProfile->address ?? '' }}",
        "addressLocality": "{{ $storeProfile->city ?? 'Jambi' }}",
        "addressRegion": "Jambi",
        "postalCode": "",
        "addressCountry": "ID"
      },
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "08:00",
        "closes": "17:00"
      },
      "sameAs": [
        "https://www.instagram.com/{{ $storeProfile->social_instagram ?? 'pawon3d' }}/"
      ]
    }
    </script>
</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] montserrat-regular">
    <!-- Header -->
    <header class="sticky top-0 bg-[#74512d] z-50 shadow-sm">
        <nav
            class="max-w-[1280px] mx-auto px-4 md:px-12 lg:px-[50px] py-0 h-16 md:h-20 lg:h-[100px] flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-4 md:gap-[40px]">
                <a class="w-12 h-12 md:w-14 md:h-14 lg:w-[64px] lg:h-[64px]" href="/" wire:navigate>
                    @if (!empty($storeProfile->logo))
                        <img src="{{ asset('storage/' . $storeProfile->logo) }}"
                            alt="{{ $storeProfile->name ?? 'Pawon3D' }}" class="w-full h-full object-contain">
                    @else
                        <picture>
                            <source srcset="{{ asset('assets/bakery-logo.webp') }}" type="image/webp">
                            <img src="{{ asset('assets/bakery-logo.png') }}"
                                alt="{{ $storeProfile->name ?? 'Pawon3D' }}" class="w-full h-full object-contain">
                        </picture>
                    @endif
                </a>

                <!-- Navigation -->
                <div class="hidden md:flex items-center gap-[5px]">
                    <a href="/landing-produk" wire:navigate
                        class="px-3 lg:px-[20px] py-[10px] text-sm lg:text-[18px] montserrat-medium text-white hover:border-b-2 hover:border-white transition-all {{ request()->routeIs('landing-produk*') ? 'border-b-2 border-white' : '' }}">
                        Produk
                    </a>
                    <a href="/#wilayah"
                        class="px-3 lg:px-[20px] py-[10px] text-sm lg:text-[18px] montserrat-medium text-white hover:border-b-2 hover:border-white transition-all">
                        Wilayah Pesan
                    </a>
                    <a href="/#carapesan"
                        class="px-3 lg:px-[20px] py-[10px] text-sm lg:text-[18px] montserrat-medium text-white hover:border-b-2 hover:border-white transition-all">
                        Cara Pesan
                    </a>
                    <a href="/#poin"
                        class="px-3 lg:px-[20px] py-[10px] text-sm lg:text-[18px] montserrat-medium text-white hover:border-b-2 hover:border-white transition-all">
                        Dapatkan Poin
                    </a>
                    <a href="/#tentang"
                        class="px-3 lg:px-[20px] py-[10px] text-sm lg:text-[18px] montserrat-medium text-white hover:border-b-2 hover:border-white transition-all">
                        Tentang
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-4 md:gap-[40px]">
                <!-- WhatsApp Button -->
                <a href="https://wa.me/{{ $storeProfile->contact ?? '628123456789' }}" target="_blank"
                    class="hidden md:flex items-center gap-2 lg:gap-[10px] px-3 lg:px-[20px] py-2 lg:py-[10px] text-base lg:text-[20px] montserrat-medium text-white hover:bg-[#5d3f23] transition-all rounded-md">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                    </svg>
                    Pesan Sekarang
                </a>

                {{-- login button --}}
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="hidden md:flex items-center gap-2 lg:gap-[10px] px-3 lg:px-[20px] py-2 lg:py-[10px] text-base lg:text-[20px] montserrat-medium text-white hover:bg-[#5d3f23] transition-all rounded-md">
                        Dashboard
                    </a>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="hidden md:flex items-center gap-2 lg:gap-[10px] px-3 lg:px-[20px] py-2 lg:py-[10px] text-base lg:text-[20px] montserrat-medium text-white hover:bg-[#5d3f23] transition-all rounded-md">
                        Masuk
                    </a>
                @endguest
            </div>

            <!-- Mobile Menu Toggle -->
            <button type="button" onclick="toggleMobileMenu()" class="md:hidden text-white p-2">
                <svg id="menu-icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="menu-icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div id="nav-menu"
            class="md:hidden bg-[#74512d] border-t border-[#5d3f23] overflow-hidden transition-all duration-300 ease-out absolute w-full left-0"
            style="max-height: 0; opacity: 0;">
            <div class="px-4 py-3 flex flex-col gap-2">
                <a href="/landing-produk" wire:navigate
                    class="px-4 py-2 text-white montserrat-medium hover:bg-[#5d3f23] rounded">
                    Produk
                </a>
                <a href="/#wilayah" class="px-4 py-2 text-white montserrat-medium hover:bg-[#5d3f23] rounded">
                    Wilayah Pesan
                </a>
                <a href="/#carapesan" class="px-4 py-2 text-white montserrat-medium hover:bg-[#5d3f23] rounded">
                    Cara Pesan
                </a>
                <a href="/#poin" class="px-4 py-2 text-white montserrat-medium hover:bg-[#5d3f23] rounded">
                    Dapatkan Poin
                </a>
                <a href="/#tentang" class="px-4 py-2 text-white montserrat-medium hover:bg-[#5d3f23] rounded">
                    Tentang
                </a>
                <a href="https://wa.me/{{ $storeProfile->contact ?? '628123456789' }}" target="_blank"
                    class="px-4 py-2 text-white montserrat-medium bg-green-600 hover:bg-green-700 rounded flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                    </svg>
                    Pesan Sekarang
                </a>

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="hidden md:flex items-center gap-2 lg:gap-[10px] px-3 lg:px-[20px] py-2 lg:py-[10px] text-base lg:text-[20px] montserrat-medium text-white hover:bg-[#5d3f23] transition-all rounded-md">
                        Dashboard
                    </a>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="hidden md:flex items-center gap-2 lg:gap-[10px] px-3 lg:px-[20px] py-2 lg:py-[10px] text-base lg:text-[20px] montserrat-medium text-white hover:bg-[#5d3f23] transition-all rounded-md">
                        Masuk
                    </a>
                @endguest
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-[#252324] text-white">
        <div class="max-w-[1280px] mx-auto px-6 md:px-12 lg:px-20 py-10 md:py-[44px]">
            <!-- Top Section: Logo, Ikuti Kami, Halal -->
            <div
                class="flex flex-col md:flex-row items-center justify-between gap-8 pb-8 md:pb-[40px] mb-8 md:mb-[40px] border-b border-white/20">
                <!-- Logo -->
                <div class="w-20 h-20 md:w-[100px] md:h-[100px]">
                    @if (!empty($storeProfile->logo))
                        <img src="{{ asset('storage/' . $storeProfile->logo) }}"
                            alt="{{ $storeProfile->name ?? 'Pawon3D' }}" class="w-full h-full object-contain">
                    @else
                        <picture>
                            <source srcset="{{ asset('assets/bakery-logo.webp') }}" type="image/webp">
                            <img src="{{ asset('assets/bakery-logo.png') }}"
                                alt="{{ $storeProfile->name ?? 'Pawon3D' }}" class="w-full h-full object-contain">
                        </picture>
                    @endif
                </div>

                <!-- Ikuti Kami & Instagram -->
                <div class="flex items-center gap-4">
                    <a href="https://www.instagram.com/{{ $storeProfile->social_instagram ? $storeProfile->social_instagram : 'pawon3d' }}/"
                        target="_blank"
                        class="flex items-center justify-center gap-4 hover:opacity-80 transition-all">
                        <span class="text-lg md:text-[20px] montserrat-bold text-white whitespace-nowrap">Ikuti
                            Kami</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                </div>

                <!-- Halal Logo -->
                <div class="w-[38px] h-[68px]">
                    <picture>
                        <source srcset="{{ asset('img/halal.webp') }}" type="image/webp">
                        <img src="{{ asset('img/halal.png') }}" alt="Halal" class="w-full h-full object-contain">
                    </picture>
                </div>
            </div>

            <!-- Footer Content Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 md:gap-8 mb-12 md:mb-[60px]">
                <!-- Kontak Kami & Alamat -->
                <div class="flex flex-col gap-8 md:gap-[40px] text-center sm:text-left">
                    <!-- Kontak Kami -->
                    <div>
                        <h3 class="text-lg md:text-[20px] montserrat-bold mb-[15px]">Kontak Kami</h3>
                        <div class="flex flex-col gap-3 md:gap-[15px] items-center sm:items-start">
                            <a href="tel:{{ $storeProfile->contact ? $storeProfile->contact : '081234567891' }}"
                                class="flex items-center gap-[10px] text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">
                                <svg class="w-5 h-5 md:w-[22px] md:h-[22px]" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                {{ $storeProfile->contact ? $storeProfile->contact : '081234567891' }}
                            </a>
                            <a href="mailto:{{ $storeProfile->email ? $storeProfile->email : 'pawon3d@gmail.com' }}"
                                class="flex items-center gap-[10px] text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">
                                <svg class="w-5 h-5 md:w-[22px] md:h-[22px]" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                </svg>
                                {{ $storeProfile->email ? $storeProfile->email : 'pawon3d@gmail.com' }}
                            </a>
                        </div>
                    </div>

                    <!-- Alamat dan Lokasi -->
                    <div>
                        <h3 class="text-lg md:text-[20px] montserrat-bold mb-[10px]">Alamat dan Lokasi</h3>
                        <div class="flex flex-col gap-1 md:gap-[10px]">
                            <p class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px]">
                                {{ $storeProfile->address ?? 'Jl. Jenderal Sudirman Km.3' }}</p>
                            <p class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px]">
                                {{ $storeProfile->city ?? 'Jambi' }}, Indonesia</p>
                        </div>
                    </div>
                </div>

                <!-- Jelajahi -->
                <div class="text-center sm:text-left">
                    <h3 class="text-lg md:text-[20px] montserrat-bold mb-[15px]">Jelajahi</h3>
                    <ul class="flex flex-col gap-3 md:gap-[15px]">
                        <li><a href="/landing-produk" wire:navigate
                                class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">Produk</a>
                        </li>
                        <li><a href="/#wilayah"
                                class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">Wilayah
                                Pesan</a></li>
                        <li><a href="/#carapesan"
                                class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">Cara
                                Pesan</a></li>
                        <li><a href="/#poin"
                                class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">Dapatkan
                                Poin</a></li>
                    </ul>
                </div>

                <!-- Informasi -->
                <div class="text-center sm:text-left">
                    <h3 class="text-lg md:text-[20px] montserrat-bold mb-[15px]">Informasi</h3>
                    <ul class="flex flex-col gap-3 md:gap-[15px]">
                        <li><a href="/#tentang"
                                class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">Tentang
                                Kami</a></li>
                        <li><a href="/#wilayah"
                                class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">Lokasi
                                Kami</a></li>
                        <li><a href="/#carapesan"
                                class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">Kontak
                                Kami</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div class="text-center sm:text-left">
                    <h3 class="text-lg md:text-[20px] montserrat-bold mb-[15px]">Bantuan</h3>
                    <ul class="flex flex-col gap-3 md:gap-[15px]">
                        <li><a href="/landing-faq" wire:navigate
                                class="text-[#c4c4c4] montserrat-regular text-base md:text-[18px] hover:text-white transition-colors">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center border-t border-white/10 pt-8">
                <p class="text-base md:text-[20px] montserrat-medium text-white/80">
                    © {{ date('Y') }} {{ $storeProfile->name ?? 'pawon3D' }}. All rights reserved
                </p>
            </div>
        </div>
    </footer>


    <script>
        // Mobile Menu Toggle Function
        // Use window scope to prevent redeclaration errors on wire:navigate
        window.mobileMenuOpen = false;

        function toggleMobileMenu() {
            const menu = document.getElementById('nav-menu');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');

            window.mobileMenuOpen = !window.mobileMenuOpen;

            if (window.mobileMenuOpen) {
                menu.style.maxHeight = '400px';
                menu.style.opacity = '1';
                iconOpen.classList.add('hidden');
                iconClose.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                menu.style.maxHeight = '0';
                menu.style.opacity = '0';
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        // Close menu when clicking on a link
        document.querySelectorAll('#nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.mobileMenuOpen) {
                    toggleMobileMenu();
                }
            });
        });
    </script>
</body>

</html>
