@php $locale = app()->getLocale(); @endphp

<section class="relative h-[88vh] min-h-[560px] max-h-[820px] overflow-hidden bg-brand-dark" data-hero-slider>
    @foreach($section->items as $i => $slide)
        <div class="hero-slide absolute inset-0 {{ $i === 0 ? 'is-active' : '' }}">
            @if($slide->image)
                <img src="{{ asset('storage/' . $slide->image) }}" alt="" class="absolute inset-0 w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/55 to-brand-dark/20"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-brand-dark/70 via-transparent to-transparent"></div>

            <div class="relative h-full max-w-7xl mx-auto px-5 lg:px-8 flex flex-col justify-end pb-28 lg:pb-32">
                <span class="site-rule mb-6"></span>
                <h1 class="font-display text-ivory text-4xl sm:text-5xl lg:text-6xl font-medium leading-[1.08] max-w-2xl">
                    {{ $slide->getTranslation('heading', $locale) }}
                </h1>
                <p class="mt-5 text-ivory/80 text-lg max-w-xl leading-relaxed">
                    {{ $slide->getTranslation('body', $locale) }}
                </p>

                @if($slide->link_url)
                    <div class="mt-9">
                        <a href="{{ $slide->link_url }}"
                           class="inline-flex items-center gap-2 h-12 px-7 rounded-full bg-gold text-brand-dark font-display font-semibold tracking-wide hover:bg-gold-light transition-colors shadow-lg shadow-black/20">
                            {{ $slide->getTranslation('link_label', $locale) }}
                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

    @if($section->items->count() > 1)
        <div class="absolute z-10 bottom-10 inset-x-0 flex justify-center items-center gap-2.5">
            @foreach($section->items as $i => $slide)
                <button data-hero-dot type="button" aria-label="Slide {{ $i + 1 }}"
                        class="w-2.5 h-2.5 rounded-full transition-colors {{ $i === 0 ? 'bg-gold' : 'bg-ivory/40' }}"></button>
            @endforeach
        </div>
    @endif
</section>
