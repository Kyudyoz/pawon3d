<div class="bg-[#EAEAEA] min-h-screen">
    {{-- Back Button & Title --}}
    <div class="flex flex-col sm:flex-row sm:items-center gap-4 px-4 md:px-12 lg:px-16 py-6 md:py-8">
        <a href="{{ route('home') }}" wire:navigate
            class="bg-[#313131] text-[#F6F6F6] px-5 md:px-6 py-2 rounded-2xl shadow flex items-center justify-center gap-2 hover:bg-[#252324] transition-colors w-max">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            <span class="font-semibold text-sm md:text-base">Kembali</span>
        </a>
        <span class="text-[#666666] font-medium text-lg md:text-xl">Daftar Menu</span>
    </div>

    {{-- Main Content --}}
    <div class="flex flex-col gap-6 md:gap-[30px] items-center w-full px-4 md:px-12 lg:px-16 pb-12 md:pb-16">
        {{-- Method Selector --}}
        <div class="w-full max-w-[1150px]">
            <div class="flex flex-wrap items-stretch bg-[#fafafa] rounded-[15px] shadow-sm min-h-[80px] md:h-[100px] lg:h-[120px] overflow-hidden">
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

        {{-- Products Container --}}
        <div class="w-full max-w-[1150px]">
            <div class="bg-[#fafafa] rounded-[15px] shadow-sm p-4 md:p-8">
                {{-- Search and Filter --}}
                <div class="flex items-center gap-2 md:gap-4 mb-8 w-full">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 md:pl-4 pointer-events-none">
                            <svg class="w-4 h-4 text-[#666666]" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" wire:model.live.debounce.300ms="search"
                            class="w-full py-2 md:py-2.5 pl-9 md:pl-10 pr-3 md:pr-4 text-sm md:text-[16px] montserrat-medium text-[#959595] border-[0.5px] border-[#666666] rounded-[20px] bg-white focus:ring-0 focus:border-[#666666]"
                            placeholder="Cari Produk">
                    </div>
                    <button class="flex items-center gap-1 md:gap-2 px-1 md:px-2 py-2 md:py-2.5">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-[#666666]" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" />
                        </svg>
                        <span class="text-sm md:text-[16px] montserrat-medium text-[#666666]">Filter</span>
                    </button>
                </div>

                {{-- Products Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-3 md:gap-6">
                    @forelse ($exploreProducts as $product)
                        <a href="{{ route('landing-produk-detail', $product) }}" wire:navigate
                            class="flex flex-col gap-4 pb-6 w-full hover:scale-105 transition-transform group">
                            <div class="w-full aspect-video md:aspect-square rounded-[15px] shadow-sm overflow-hidden bg-[#eaeaea]">
                                @if ($product->product_image)
                                    <img src="{{ asset('storage/' . $product->product_image) }}"
                                        alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity">
                                @else
                                    <img src="{{ asset('/img/no-img.jpg') }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover">
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

                {{-- Load More Button --}}
                @if ($hasMore)
                    <div class="flex justify-center mt-8 px-4">
                        <button wire:click="loadMore"
                            class="px-6 md:px-9 py-3 md:py-4 bg-[#74512d] rounded-[15px] montserrat-semibold text-sm md:text-[16px] text-white hover:bg-[#5d3f23] transition-all inline-flex items-center justify-center gap-2 w-full sm:w-auto">
                            <span wire:loading.remove wire:target="loadMore">Lihat Lebih Banyak</span>
                            <span wire:loading wire:target="loadMore">Memuat...</span>
                        </button>
                    </div>
                @endif

                {{-- Product Count Info --}}
                <div class="text-center mt-4 text-[14px] montserrat-medium text-[#959595]">
                    Menampilkan {{ $exploreProducts->count() }} dari {{ $totalProducts }} produk
                </div>
            </div>
        </div>
    </div>
</div>
