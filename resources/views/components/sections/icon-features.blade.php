@php $locale = app()->getLocale(); @endphp

<section class="relative -mt-16 lg:-mt-20 z-20">
    <div class="max-w-6xl mx-auto px-5 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($section->items as $item)
                <div class="feature-card group reveal-up relative bg-ivory rounded-3xl shadow-xl shadow-brand-dark/10 ring-1 ring-brand/5 hover:ring-gold/30 p-6 lg:p-7 flex flex-col items-center text-center gap-3 cursor-default">

                    {{-- diagonal shine sweep --}}
                    <span class="feature-shine"></span>

                    {{-- icon badge --}}
                    <div class="feature-badge relative w-16 h-16 flex items-center justify-center rounded-full bg-brand/8 ring-1 ring-brand/10 transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] group-hover:bg-gradient-to-br group-hover:from-gold group-hover:to-gold-light group-hover:ring-gold/50 group-hover:scale-110 group-hover:-rotate-6">
                        <span class="feature-ring absolute inset-0 rounded-full"></span>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt=""
                                 class="feature-icon relative w-8 h-8 object-contain transition-transform duration-500">
                        @endif
                    </div>

                    <div class="relative">
                        <p class="feature-heading relative inline-block font-display text-brand-dark font-semibold text-base lg:text-lg">
                            {{ $item->getTranslation('heading', $locale) }}
                            <span class="absolute start-0 -bottom-1 h-[2px] w-0 bg-gradient-to-r from-gold to-gold-light transition-all duration-500 ease-out group-hover:w-full"></span>
                        </p>
                        <p class="text-ink/55 text-xs lg:text-sm mt-1.5">{{ $item->getTranslation('body', $locale) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
