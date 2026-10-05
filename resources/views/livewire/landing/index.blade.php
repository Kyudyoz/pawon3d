<div>
    <!-- Hero Section -->
    <section class="relative w-full h-[500px] md:h-[650px] lg:h-[800px] bg-[#333333] overflow-hidden">
        <!-- LCP Hero Image -->
        <picture>
            @if ($storeProfile->banner)
                <img src="{{ asset('storage/' . $storeProfile->banner) }}" alt="{{ $storeProfile->name ?? 'Pawon3D' }}"
                    class="absolute inset-0 w-full h-full object-cover object-center opacity-40 z-10" fetchpriority="high"
                    loading="eager" width="1280" height="800">
            @else
                <source srcset="{{ asset('img/apem.webp') }}" type="image/webp">
                <img src="{{ asset('img/apem.jpg') }}" alt="{{ $storeProfile->name ?? 'Pawon3D' }}"
                    class="absolute inset-0 w-full h-full object-cover object-center opacity-40 z-10"
                    fetchpriority="high" loading="eager" width="1053" height="798">
            @endif
        </picture>

        <!-- Hero Content -->
        <div class="relative z-20 h-full flex items-center px-4 md:px-12 lg:px-20">
            <div class="max-w-full md:max-w-[610px]">
                <p class="text-base md:text-xl lg:text-[24px] font-bold montserrat-regular text-[#74512d] text-shadow-2xs mb-4 md:mb-6"
                    style="-webkit-text-stroke: 1px {{ $storeProfile->stroke_color ?? '#fff' }}; text-stroke: 1px {{ $storeProfile->stroke_color ?? '#fff' }}; text-shadow: 1px 1px 0 {{ $storeProfile->stroke_color ?? '#fff' }}, -1px -1px 0 {{ $storeProfile->stroke_color ?? '#fff' }}, 1px -1px 0 {{ $storeProfile->stroke_color ?? '#fff' }}, -1px 1px 0 {{ $storeProfile->stroke_color ?? '#fff' }};">
                    {{ $storeProfile->name ?? 'Pawon3D' }}
                </p>

                <h1
                    class="text-3xl md:text-5xl lg:text-[64px] leading-tight md:leading-[70px] lg:leading-[85px] pacifico-regular text-white mb-6 md:mb-8 lg:mb-12">
                    {{ $storeProfile->tagline != '' ? $storeProfile->tagline : 'Kue Rumahan Lezat, Sehangat Pelukan Ibu' }}
                </h1>

                <div class="flex flex-col sm:flex-row gap-4 md:gap-6 items-start">
                    <a href="https://wa.me/{{ $storeProfile->contact != '' ? $storeProfile->contact : '628123456789' }}"
                        target="_blank"
                        class="px-6 md:px-9 py-3 md:py-6 bg-[#e9bd8c] rounded-[15px] montserrat-bold text-base md:text-[20px] text-[#74512d] hover:bg-[#d4a876] transition-all inline-block w-full sm:w-auto text-center">
                        Pesan Sekarang
                    </a>
                    <a href="#carapesan"
                        class="montserrat-semibold text-base md:text-[20px] text-white flex flex-col items-start py-2 md:py-3">
                        <span>Lihat</span>
                        <span class="flex items-center gap-2">
                            Cara Pesan
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Section -->
    <section class="bg-[#fafafa] py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12 md:mb-[91px] max-w-full md:max-w-[872px] mx-auto">
                <h2
                    class="text-2xl md:text-3xl lg:text-[38px] leading-tight md:leading-[60px] pacifico-regular text-[#333333] mb-6 md:mb-[37px]">
                    Produk Unggulan Kami
                </h2>
                <p class="text-sm md:text-base montserrat-medium text-[#525252] leading-normal">
                    Pilihan kue yang paling disukai pembeli!<br>
                    Dibuat dari bahan berkualitas dan rasa yang bikin nagih, siap menemani hari-harimu.
                </p>
            </div>

            <div class="flex gap-5 items-center justify-center overflow-x-auto pb-4">
                @forelse ($products as $product)
                    <a href="{{ route('landing-produk-detail', $product) }}" wire:navigate
                        class="flex flex-col gap-[15px] pb-[25px] min-w-[234px] hover:scale-105 transition-transform">
                        <div class="w-[234px] h-[155px] rounded-[15px] shadow-sm overflow-hidden bg-[#eaeaea]">
                            @if ($product->product_image)
                                <img src="{{ asset('storage/' . $product->product_image) }}"
                                    alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('/img/no-img.jpg') }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="text-center px-[15px] flex flex-col gap-[20px]">
                            <div class="min-h-[30px] flex flex-col gap-[5px] items-center">
                                <h3 class="text-[16px] montserrat-medium text-[#666666] line-clamp-2">
                                    {{ $product->name }}</h3>
                            </div>
                            <p class="text-[18px] montserrat-semibold text-[#666666]">
                                Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-[#666666] text-center">Tidak ada produk unggulan saat ini.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Points Section -->
    <section class="relative py-20 bg-[#fafafa] overflow-hidden bg-cover bg-center"
        style="background-image: url('{{ asset('img/unggulan/kertas.jpg') }}');">
        <div class="max-w-full md:max-w-[572px] mx-auto px-4 text-center relative z-10">
            <h2
                class="text-2xl md:text-3xl lg:text-[38px] leading-tight md:leading-[60px] pacifico-regular text-[#933c24] mb-4 md:mb-6">
                Jadi Pelanggan dan<br>Kumpulkan Poin!
            </h2>
            <div class="text-sm md:text-base montserrat-medium text-[#333333] mb-6 md:mb-9 leading-normal">
                <p class="mb-2">Dapatkan <span class="montserrat-bold">1 poin</span> dengan belanja kelipatan <span
                        class="montserrat-bold">Rp10.000</span>.</p>
                <p class="mb-2">Poin juga dapat dikumpulkan melalui review di <span
                        class="montserrat-bold">Story</span>,
                    <span class="montserrat-bold">Media Sosial</span>, dan review di <span
                        class="montserrat-bold">Google
                        Maps</span>.
                </p>
            </div>
            <a href="#poin"
                class="inline-block px-6 md:px-9 py-3 md:py-6 bg-[#74512d] rounded-[15px] montserrat-semibold text-base md:text-[20px] text-white hover:bg-[#5d3f23] transition-all">
                Lihat Cara Dapat dan Tukar Poin!
            </a>
        </div>

        <!-- Decorative images (purely visual) -->
        <div
            class="absolute -bottom-1/4 inset-x-0 flex justify-between items-end pointer-events-none z-0 overflow-hidden">
            <img src="{{ asset('img/unggulan/kiri.png') }}" alt="" aria-hidden="true" loading="lazy"
                class="max-h-[300px]">
            <img src="{{ asset('img/unggulan/kanan.png') }}" alt="" aria-hidden="true" loading="lazy"
                class="max-h-[300px]">
        </div>
    </section>

    <!-- Menu/Daftar Menu Section -->
    <section class="py-20 w-full bg-[#fafafa]" id="menu">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10 md:mb-[60px]">
                <h2
                    class="text-2xl md:text-3xl lg:text-[38px] leading-tight md:leading-[60px] pacifico-regular text-[#333333]">
                    Daftar Menu</h2>
            </div>

            <!-- Method Selector -->
            <div class="w-full max-w-[1150px] mx-auto">
                <div
                    class="flex flex-wrap items-stretch bg-[#fafafa] rounded-[15px] shadow-sm min-h-[80px] md:h-[100px] lg:h-[120px] overflow-hidden">
                    <button wire:click="$set('method', 'pesanan-reguler')"
                        class="flex-1 flex flex-col items-center justify-center gap-1 min-w-[100px] py-3 {{ $method === 'pesanan-reguler' ? 'bg-[#fafafa] border-b-4 border-[#74512d]' : 'bg-[#fafafa]' }}">
                        <flux:icon icon="cake"
                            class="size-6 md:size-8 {{ $method === 'pesanan-reguler' ? 'text-[#74512d]' : 'text-[#6c7068] opacity-90' }}" />
                        <span
                            class="text-[10px] md:text-sm lg:text-[16px] montserrat-{{ $method === 'pesanan-reguler' ? 'bold' : 'medium' }} {{ $method === 'pesanan-reguler' ? 'text-[#74512d]' : 'text-[#6c7068] opacity-90' }}">Pesanan
                            Reguler</span>
                    </button>

                    <button wire:click="$set('method', 'pesanan-kotak')"
                        class="flex-1 flex flex-col items-center justify-center gap-1 min-w-[100px] py-3 {{ $method === 'pesanan-kotak' ? 'bg-[#fafafa] border-b-4 border-[#74512d]' : 'bg-[#fafafa]' }}">
                        <flux:icon icon="package-open"
                            class="size-6 md:size-8 {{ $method === 'pesanan-kotak' ? 'text-[#74512d]' : 'text-[#6c7068] opacity-90' }}" />
                        <span
                            class="text-[10px] md:text-sm lg:text-[16px] montserrat-{{ $method === 'pesanan-kotak' ? 'bold' : 'medium' }} {{ $method === 'pesanan-kotak' ? 'text-[#74512d]' : 'text-[#6c7068] opacity-90' }}">Pesanan
                            Kotak</span>
                    </button>

                    <button wire:click="$set('method', 'siap-beli')"
                        class="flex-1 flex flex-col items-center justify-center gap-1 min-w-[100px] py-3 {{ $method === 'siap-beli' ? 'bg-[#fafafa] border-b-4 border-[#74512d]' : 'bg-[#fafafa]' }}">
                        <flux:icon icon="dessert"
                            class="size-6 md:size-8 {{ $method === 'siap-beli' ? 'text-[#74512d]' : 'text-[#6c7068] opacity-90' }}" />
                        <span
                            class="text-[10px] md:text-sm lg:text-[16px] montserrat-{{ $method === 'siap-beli' ? 'bold' : 'medium' }} {{ $method === 'siap-beli' ? 'text-[#74512d]' : 'text-[#6c7068] opacity-90' }}">Siap
                            Saji</span>
                    </button>
                </div>
            </div>



            <!-- Products Container -->
            <div class="max-w-[1150px] mx-auto">

                <!-- Products Grid -->
                <div class="bg-[#fafafa] rounded-[15px] shadow-sm p-4 md:p-8 mb-10">
                    <!-- Search and Filter -->
                    <div class="flex items-center gap-2 md:gap-4 mb-8 w-full mx-auto">
                        <div class="relative flex-1 max-w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 md:pl-4 pointer-events-none">
                                <svg class="w-4 h-4 text-[#666666]" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live="search"
                                class="w-full py-2 md:py-2.5 pl-9 md:pl-10 pr-3 md:pr-4 text-sm md:text-[16px] montserrat-medium text-[#959595] border-[0.5px] border-[#666666] rounded-[20px] bg-white focus:ring-0 focus:border-[#666666]"
                                placeholder="Cari Produk">
                        </div>
                        <button class="flex items-center gap-1 md:gap-2 px-1 md:px-2 py-2 md:py-2.5">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-[#666666]" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" />
                            </svg>
                            <span class="text-sm md:text-[16px] montserrat-medium text-[#666666]">Filter</span>
                        </button>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-3 md:gap-6">
                        @forelse ($exploreProducts as $product)
                            <a href="{{ route('landing-produk-detail', $product) }}" wire:navigate
                                class="flex flex-col gap-4 pb-6 w-full hover:scale-105 transition-transform group">
                                <div
                                    class="w-full aspect-video md:aspect-square rounded-[15px] shadow-sm overflow-hidden bg-[#eaeaea]">
                                    @if ($product->product_image)
                                        <img src="{{ asset('storage/' . $product->product_image) }}"
                                            alt="{{ $product->name }}" loading="lazy"
                                            class="w-full h-full object-cover group-hover:opacity-90 transition-opacity">
                                    @else
                                        <img src="{{ asset('/img/no-img.jpg') }}" alt="{{ $product->name }}"
                                            loading="lazy" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="text-center px-1 flex flex-col gap-4">
                                    <div class="min-h-[50px] md:min-h-[70px] flex flex-col gap-1 items-center">
                                        <h3 class="text-sm md:text-base montserrat-medium text-[#666666] line-clamp-2">
                                            {{ $product->name }}</h3>
                                        
                                    </div>
                                    <p class="text-base md:text-lg montserrat-semibold text-[#666666]">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-12 text-[#666666] montserrat-medium">
                                Tidak ada produk tersedia
                            </div>
                        @endforelse
                    </div>

                    {{-- <!-- Pagination -->
                    <div class="mt-6">
                        {{ $exploreProducts->links(data: ['scrollTo' => false]) }}
                    </div> --}}
                </div>

                <!-- Selengkapnya Button -->
                <div class="flex justify-center">
                    <a href="/landing-produk" wire:navigate
                        class="px-6 md:px-9 py-3 md:py-6 bg-[#74512d] rounded-[15px] montserrat-semibold text-base md:text-[20px] text-white hover:bg-[#5d3f23] transition-all inline-block w-full sm:w-auto text-center">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact/Location Section -->
    <section id="wilayah" class="relative py-12 md:py-20 bg-[#252324]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10 md:mb-12">
                <h2
                    class="text-2xl md:text-3xl lg:text-[38px] leading-tight md:leading-[60px] pacifico-regular text-white">
                    Lokasi Toko dan Wilayah Pemesanan
                </h2>
            </div>

            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start justify-center mb-10 md:mb-8">
                <div
                    class="flex flex-col items-center md:items-start text-center md:text-left text-white w-full md:max-w-[225px]">
                    <h3 class="text-lg md:text-[18px] montserrat-bold mb-[17px]">Wilayah Pemesanan</h3>
                    <ul
                        class="text-sm md:text-[16px] montserrat-medium text-[#c4c4c4] space-y-1 md:space-y-0 list-disc list-inside">
                        <li>Muara Bulian</li>
                        <li>Muara Tembesi</li>
                        <li>Muara Jambi</li>
                        <li>Kota Jambi</li>
                    </ul>
                    <p class="text-sm md:text-[16px] montserrat-medium text-[#c4c4c4] mt-4 md:mt-6">
                        Senin - Sabtu <br>
                        08:00 - 17:00 WIB
                    </p>
                </div>

                <div class="w-full md:w-[585px] h-[250px] md:h-[346px] rounded-[10px] overflow-hidden">
                    <a href="{{ $storeProfile->location != '' ? $storeProfile->location : 'https://maps.app.goo.gl/sC1y1x1BraBVEu117' }}"
                        target="_blank" rel="noopener noreferrer">
                        @if ($storeProfile->building)
                            <img src="{{ asset('storage/' . $storeProfile->building) }}"
                                alt="Lokasi Toko {{ $storeProfile->name != '' ? $storeProfile->name : 'Pawon3D' }}"
                                loading="lazy" class="w-full h-full object-cover hover:opacity-90 transition-opacity">
                        @else
                            <picture>
                                <source srcset="{{ asset('img/lokasi.webp') }}" type="image/webp">
                                <img src="{{ asset('img/lokasi.png') }}"
                                    alt="Lokasi Toko {{ $storeProfile->name != '' ? $storeProfile->name : 'Pawon3D' }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover hover:opacity-90 transition-opacity">
                            </picture>
                        @endif
                    </a>
                </div>

                <div
                    class="flex flex-col items-center md:items-end text-center md:text-end text-white w-full md:max-w-[225px]">
                    <h3 class="text-lg md:text-[18px] montserrat-bold mb-[17px]">Metode Pengambilan Pesanan</h3>
                    <ul
                        class="text-sm md:text-[16px] montserrat-medium text-[#c4c4c4] space-y-1 md:space-y-0 list-disc list-inside text-center md:text-right">
                        <li>Pengambilan di Toko</li>
                        <li>Pengiriman langsung (terbatas jarak 2 km)</li>
                    </ul>
                </div>
            </div>

            <div class="text-center px-4">
                <h3 class="text-lg md:text-[18px] montserrat-bold text-white mb-2 md:mb-[17px]">Lokasi Toko</h3>
                <p class="text-sm md:text-[16px] montserrat-medium text-[#c4c4c4] max-w-[561px] mx-auto">
                    {{ $storeProfile->address != '' ? $storeProfile->address : 'Jl. Jenderal Sudirman Km.3, Muara Bulian, Batang Hari, Jambi' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Cara Pesan Section -->
    <section class="mx-auto py-12 md:py-20 w-full bg-[#fafafa]" id="carapesan">
        <div class="max-w-7xl mx-auto px-4 flex flex-col gap-[30px] md:gap-[50px] items-center">
            <!-- Title and Tabs -->
            <div class="flex flex-col gap-[20px] md:gap-[30px] items-center w-full max-w-[347px]">
                <h2
                    class="text-2xl md:text-3xl lg:text-[38px] pacifico-regular leading-tight md:leading-[60px] text-[#333333] text-center w-full">
                    Cara Pesan
                </h2>

                <!-- Tabs -->
                <div class="flex gap-2 md:gap-[15px] items-center justify-center w-full">
                    <button
                        class="flex-1 md:flex-none md:px-[25px] py-2 md:py-[10px] {{ $caraPesan === 'whatsapp' ? 'bg-[#74512d] text-white' : 'bg-white text-[#666666] border border-[#666666]' }} rounded-[20px] montserrat-semibold text-sm md:text-[16px] transition-colors"
                        wire:click="$set('caraPesan', 'whatsapp')">
                        WhatsApp
                    </button>
                    <button
                        class="flex-1 md:flex-none md:px-[25px] py-2 md:py-[10px] {{ $caraPesan === 'toko' ? 'bg-[#74512d] text-white' : 'bg-white text-[#666666] border border-[#666666]' }} rounded-[20px] montserrat-medium text-sm md:text-[16px] transition-colors"
                        wire:click="$set('caraPesan', 'toko')">
                        Langsung di Toko
                    </button>
                </div>
            </div>

            <!-- Konten Cara Pesan -->
            @if ($caraPesan === 'whatsapp')
                <div class="flex flex-col lg:flex-row gap-6 md:gap-[25px] items-start justify-center w-full">
                    <!-- Left Column -->
                    <div class="flex flex-col gap-6 md:gap-[30px] flex-1 w-full lg:w-auto">
                        <!-- Step 1 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[440px]">
                            <ol
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Pilih menu <span class="montserrat-bold">Pesanan Reguler</span> atau <span
                                        class="montserrat-bold">Pesanan Kotak</span> dan lihat <span
                                        class="montserrat-bold">daftar menu</span></li>
                            </ol>
                        </div>

                        <!-- Step 2 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[388px]">
                            <ol start="2"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Pilih satu atau lebih <span class="montserrat-bold">produk</span> yang diinginkan,
                                    lalu
                                    <span class="montserrat-bold">screenshot</span>.
                                </li>
                            </ol>
                        </div>

                        <!-- Step 3 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[440px]">
                            <ol start="3"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Tekan <span class="montserrat-bold">Pesan Sekarang</span> untuk beralih ke <span
                                        class="montserrat-bold">WhatsApp</span> dan kirimkan hasil <span
                                        class="montserrat-bold">screenshot</span> untuk melakukan <span
                                        class="montserrat-bold">konfirmasi pesanan.</span></li>
                            </ol>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="flex flex-col gap-6 md:gap-[30px] flex-1 w-full lg:w-auto items-center lg:items-end">
                        <!-- Step 4 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[613px]">
                            <ol start="4"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Lakukan <span class="montserrat-bold">konfirmasi pesanan</span> dan <span
                                        class="montserrat-bold">pembayaran,</span> maka pesanan akan dicatat (pastikan
                                    pesanan berada di dalam <span class="montserrat-bold">wilayah pemesanan</span>)
                                </li>
                            </ol>
                        </div>

                        <!-- Step 5 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[558px]">
                            <ol start="5"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Terima <span class="montserrat-bold">invoice</span> dan ambil pesanan <span
                                        class="montserrat-bold">sesuai kesepakatan</span> atau <span
                                        class="montserrat-bold">tunggu kabar dari penjual.</span></li>
                            </ol>
                        </div>

                        <!-- Step 6 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[584px]">
                            <ol start="6"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Datang ke <span class="montserrat-bold">toko</span> atau <span
                                        class="montserrat-bold">tunggu
                                        pengiriman</span> untuk menerima pesanan, jika pesanan belum lunas maka lakukan
                                    pelunasan.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col lg:flex-row gap-6 md:gap-[25px] items-start justify-center w-full">
                    <!-- Left Column -->
                    <div class="flex flex-col gap-6 md:gap-[30px] flex-1 w-full lg:w-auto">
                        <!-- Step 1 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[440px]">
                            <ol
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Temui <span class="montserrat-bold">kasir</span>, pilih <span
                                        class="montserrat-bold">metode pembelian</span>, dan lihat <span
                                        class="montserrat-bold">daftar menu</span></li>
                            </ol>
                        </div>

                        <!-- Step 2 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[388px]">
                            <ol start="2"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Pilih satu atau lebih <span class="montserrat-bold">produk</span> yang diinginkan.
                                </li>
                            </ol>
                        </div>

                        <!-- Step 3 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[440px]">
                            <ol start="3"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Lakukan <span class="montserrat-bold">konfirmasi pembelian</span> dan lakukan <span
                                        class="montserrat-bold">pembayaran</span> (bayar uang muka untuk pembelian
                                    pesanan)</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="flex flex-col gap-6 md:gap-[30px] flex-1 w-full lg:w-auto items-center lg:items-end">
                        <!-- Step 4 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[613px]">
                            <ol start="4"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Terima <span class="montserrat-bold">produk</span> dan <span
                                        class="montserrat-bold">struk pembayaran</span> (jika pembelian pesanan, maka
                                    terima
                                    invoice untuk dibawa saat mengambil pesanan)</li>
                            </ol>
                        </div>

                        <!-- Step 5 -->
                        <div
                            class="bg-[#333333] rounded-[15px] px-6 md:px-[30px] py-5 md:py-[25px] shadow-sm w-full lg:max-w-[584px]">
                            <ol start="5"
                                class="list-decimal list-inside montserrat-regular text-[#fafafa] text-base md:text-[18px] leading-normal m-0">
                                <li>Jika pembelian pesanan, <span class="montserrat-bold">ambil sesuai
                                        kesepakatan</span> atau <span class="montserrat-bold">tunggu kabar dari
                                        penjual.</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Cara Dapat dan Tukar Poin Section -->
    <section class="relative py-20 bg-[#fafafa] overflow-hidden bg-cover bg-center"
        style="background-image: url('{{ asset('img/unggulan/kertas.jpg') }}');" id="poin">
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-[38px] leading-[60px] pacifico-regular text-[#933c24] mb-12">
                Cara Dapat dan Tukar Poin
            </h2>

            <div class="flex flex-col gap-6 md:gap-[42px] items-center w-full max-w-[1117px] mx-auto">
                <div
                    class="bg-[#933c24] rounded-[15px] shadow-sm px-6 md:px-[30px] py-6 md:py-[25px] w-full overflow-hidden">
                    <div class="text-base md:text-[18px] text-white text-center">
                        <p class="mb-0 montserrat-bold">Daftarkan diri sebagai pelanggan di kasir</p>
                        <p class="montserrat-medium text-sm md:text-base">(Hanya pelanggan yang akan mendapatkan poin)
                        </p>
                    </div>
                </div>

                <div
                    class="flex flex-col md:flex-row flex-wrap gap-6 md:gap-[36px] items-center justify-center w-full">
                    <div
                        class="bg-[#74512d] rounded-[15px] shadow-sm px-6 md:px-[30px] py-6 md:py-[25px] w-full md:w-auto md:min-w-[280px]">
                        <div class="text-base md:text-[18px] text-white text-center">
                            <p class="mb-0 montserrat-bold">Unggah story media sosial</p>
                            <p class="montserrat-medium text-sm md:text-base">(5 Poin untuk setiap postingan)</p>
                        </div>
                    </div>

                    <div
                        class="bg-[#933c24] rounded-[15px] shadow-sm px-6 md:px-[30px] py-6 md:py-[25px] w-full md:w-auto md:min-w-[280px]">
                        <div class="text-base md:text-[18px] text-white text-center">
                            <p class="mb-0 montserrat-bold">Belanja dan Dapatkan Poin!</p>
                            <p class="montserrat-medium text-sm md:text-base">(1 Poin untuk kelipatan Rp10.000)</p>
                        </div>
                    </div>

                    <div
                        class="bg-[#74512d] rounded-[15px] shadow-sm px-6 md:px-[30px] py-6 md:py-[25px] w-full md:w-auto md:min-w-[331px]">
                        <div class="text-base md:text-[18px] text-white text-center">
                            <p class="mb-0 montserrat-bold">Beri ulasan di Google Maps</p>
                            <p class="montserrat-medium text-sm md:text-base">(10 Poin untuk setiap ulasan)</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-[#933c24] rounded-[15px] shadow-sm px-6 md:px-[30px] py-6 md:py-[25px] w-full md:max-w-[507px]">
                    <div class="text-base md:text-[18px] text-white text-center">
                        <p class="mb-0 montserrat-bold">Tukar poin untuk potongan harga</p>
                        <p class="montserrat-medium text-sm md:text-base">(Hanya dapat dilakukan di kasir dan
                            kadaluarsa jika tidak
                            digunakan dalam 1 tahun)</p>
                    </div>
                </div>

                <div
                    class="bg-[#933c24] rounded-[15px] shadow-sm px-6 md:px-[30px] py-6 md:py-[25px] w-full md:max-w-[487px]">
                    <p class="text-base md:text-[18px] text-white text-center montserrat-medium mb-0">
                        <span class="montserrat-bold">Poin akan aktif setelah pembayaran berhasil</span> (Jika
                        pesanan batal, poin yang sudah digunakan akan hangus)
                    </p>
                </div>
            </div>
        </div>

        <!-- Decorative images -->
        <div
            class="absolute -bottom-1/4 inset-x-0 flex justify-between items-end pointer-events-none z-0 overflow-hidden">
            <img src="{{ asset('img/unggulan/kiri.png') }}" alt="" aria-hidden="true" loading="lazy"
                class="max-h-[300px]">
            <img src="{{ asset('img/unggulan/kanan.png') }}" alt="" aria-hidden="true" loading="lazy"
                class="max-h-[300px]">
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-20 bg-[#fafafa]">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-[38px] leading-[60px] pacifico-regular text-[#333333] text-center mb-[60px]">
                Tentang Kami
            </h2>

            <div class="flex flex-col lg:flex-row gap-10 md:gap-[40px] items-center lg:items-start justify-center">
                <div
                    class="flex flex-col sm:flex-row lg:flex-col gap-6 md:gap-[40px] w-full lg:w-[275px] items-center justify-center">
                    <div class="h-[200px] md:h-[239px] w-full md:w-[276px] rounded-[10px] overflow-hidden">
                        @if ($storeProfile->building)
                            <img src="{{ asset('storage/' . $storeProfile->building) }}"
                                alt="Toko {{ $storeProfile->name != '' ? $storeProfile->name : 'Pawon3D' }}"
                                loading="lazy" class="w-full h-full object-cover">
                        @else
                            <picture>
                                <source srcset="{{ asset('img/lokasi.webp') }}" type="image/webp">
                                <img src="{{ asset('img/lokasi.png') }}"
                                    alt="Toko {{ $storeProfile->name != '' ? $storeProfile->name : 'Pawon3D' }}"
                                    loading="lazy" class="w-full h-full object-cover">
                            </picture>
                        @endif
                    </div>
                    <div class="h-[150px] md:h-[183px] w-full md:w-[275px] rounded-[10px] overflow-hidden">
                        @if ($storeProfile->product_image)
                            <img src="{{ asset('storage/' . $storeProfile->product_image) }}"
                                alt="Produk {{ $storeProfile->name != '' ? $storeProfile->name : 'Pawon3D' }}"
                                loading="lazy" class="w-full h-full object-cover">
                        @else
                            <picture>
                                <source srcset="{{ asset('img/about.webp') }}" type="image/webp">
                                <img src="{{ asset('img/about.png') }}"
                                    alt="Produk {{ $storeProfile->name != '' ? $storeProfile->name : 'Pawon3D' }}"
                                    loading="lazy" class="w-full h-full object-cover">
                            </picture>
                        @endif
                    </div>
                </div>

                <div
                    class="bg-[#333333] rounded-[20px] px-6 md:px-[20px] py-8 md:py-[30px] w-full lg:w-[644px] text-white text-center">
                    <div class="mb-6 md:mb-[30px]">
                        <p class="text-2xl md:text-[30px] montserrat-semibold mb-2 md:mb-[10px]">
                            {{ $storeProfile->name != '' ? $storeProfile->name : 'Pawon3D' }}
                        </p>
                        <p class="text-sm md:text-[16px] montserrat-medium leading-relaxed md:leading-[30px]">
                            ({{ $storeProfile->type != '' ? $storeProfile->type : 'NIB: 2701230008955' }})</p>
                    </div>

                    <div class="text-sm md:text-[16px] montserrat-medium leading-relaxed md:leading-[30px]">
                        @if ($storeProfile->description)
                            <p>{!! nl2br(e($storeProfile->description)) !!}</p>
                        @else
                            <p class="mb-4 text-center">
                                <span class="montserrat-bold">Pawon3D</span> adalah toko kue yang menghadirkan cita
                                rasa
                                manis dan kehangatan keluarga dari rumah sejak tahun 2001. Pemilik yang beragama <span
                                    class="montserrat-bold">Islam</span> memastikan setiap produk yang dibuat berasal
                                dari
                                bahan yang <span class="montserrat-bold">halal, segar, dan aman dikonsumsi</span>,
                                <span class="montserrat-bold">tanpa pengawet maupun pewarna berbahaya</span>.
                            </p>

                            <p class="text-center">
                                <span class="montserrat-bold">Kue tradisional</span> adalah produk unggulan kami,
                                Pawon3D
                                percaya diri bahwa kue tradisional yang dibuat termasuk yang <span
                                    class="montserrat-bold">terbaik</span> di kelasnya. Kami percaya, kebahagiaan
                                sejati
                                dimulai dari kue yang dibuat dengan <span class="montserrat-bold">cinta, kebersihan,
                                    dan
                                    kejujuran</span>.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
