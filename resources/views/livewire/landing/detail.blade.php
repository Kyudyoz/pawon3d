@push('meta')
    <meta property="og:image" content="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('/img/no-img.jpg') }}" />
    <meta property="twitter:image" content="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('/img/no-img.jpg') }}" />
@endpush

<div class="bg-[#EAEAEA] w-full min-h-screen">
    {{-- Back Button & Title --}}
    <div class="flex flex-col sm:flex-row sm:items-center gap-4 px-4 md:px-12 lg:px-16 py-6 md:py-8">
        <button onclick="window.history.back()"
            class="bg-[#313131] text-[#F6F6F6] px-5 md:px-6 py-2 rounded-2xl shadow flex items-center justify-center gap-2 hover:bg-[#252324] transition-colors w-max">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            <span class="font-semibold text-sm md:text-base">Kembali</span>
        </button>
        <span class="text-[#666666] font-medium text-lg md:text-xl">Deskripsi Produk</span>
    </div>

    {{-- Main Content --}}
    <div class="px-4 md:px-12 lg:px-16 pb-12 md:pb-8 flex flex-col gap-8 max-w-[1280px] mx-auto">
        {{-- Product Detail Card --}}
        <div class="bg-[#FAFAFA] rounded-2xl p-6 md:p-8 shadow flex flex-col gap-8 md:gap-12">
            {{-- Top Section: Info & Image --}}
            <div class="flex flex-col-reverse md:flex-row items-start justify-between gap-8">
                {{-- Left: Product Info --}}
                <div class="flex flex-col gap-6 md:gap-8 flex-1 w-full">
                    {{-- Name & Price --}}
                    <div class="flex flex-col gap-2 md:gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <h1 class="font-medium text-2xl md:text-[30px] text-[#666666] leading-tight">{{ $product->name }}</h1>
                            
                        </div>
                        <p class="font-semibold text-xl md:text-2xl text-[#666666]">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Categories --}}
                    @if ($product->product_categories && $product->product_categories->count() > 0)
                        <div class="flex flex-col gap-3 md:gap-5 text-[#666666] max-w-md">
                            <p class="font-medium text-base md:text-lg">Kategori Produk</p>
                            <p class="font-normal text-sm md:text-base text-justify">
                                {{ $product->product_categories->pluck('category.name')->join(', ') }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Right: Product Image --}}
                <div class="rounded-2xl shadow overflow-hidden w-full md:w-[239px] h-48 md:h-[172px] flex-shrink-0">
                    @if ($product->product_image)
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('/img/no-img.jpg') }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    @endif
                </div>
            </div>

            {{-- Bottom Section: Description --}}
            @if ($product->description)
                <div class="flex flex-col gap-5 text-[#666666]">
                    <p class="font-medium text-lg">Deskripsi Produk</p>
                    <p class="font-normal text-base text-justify leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>
            @endif
        </div>

        {{-- Related Products Section --}}
        <div class="bg-[#FAFAFA] rounded-2xl p-8 shadow flex flex-col gap-8">
            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <p class="font-medium text-base md:text-lg text-[#666666]">Produk Lainnya</p>
                <a href="{{ route('landing-produk') }}" wire:navigate
                    class="bg-[#74512D] text-[#F6F6F6] px-5 md:px-6 py-2 rounded-2xl shadow hover:bg-[#5c3f23] transition-colors w-max">
                    <span class="font-semibold text-sm md:text-base">Lihat Lainnya</span>
                </a>
            </div>

            {{-- Products Grid --}}
            <div class="overflow-y-auto max-h-[542px] pr-2">
                <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 md:gap-4">
                    @foreach ($relatedProducts as $relatedProduct)
                        <a href="{{ route('landing-produk-detail', $relatedProduct) }}" wire:navigate
                            class="flex flex-col gap-3 md:gap-4 pb-4 md:pb-6 hover:scale-105 transition-transform">
                            {{-- Image --}}
                            <div class="rounded-2xl shadow overflow-hidden aspect-video">
                                @if ($relatedProduct->product_image)
                                    <img src="{{ asset('storage/' . $relatedProduct->product_image) }}"
                                        alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('/img/no-img.jpg') }}" alt="{{ $relatedProduct->name }}"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="px-2 md:px-4 flex flex-col gap-4">
                                {{-- Name & Quantity --}}
                                <div class="flex flex-col gap-2 min-h-[60px] md:min-h-[70px] items-center">
                                    <div class="flex flex-col gap-1 items-center w-full">
                                        <p class="font-medium text-sm md:text-base text-[#666666] text-center line-clamp-2 w-full">
                                            {{ $relatedProduct->name }}
                                        </p>
                                    </div>
                                    
                                </div>

                                {{-- Price --}}
                                <div
                                    class="flex items-start justify-center font-semibold text-base md:text-lg text-[#666666] text-center">
                                    <span>Rp{{ number_format($relatedProduct->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
