@php $locale = app()->getLocale(); $item = $section->items->first(); @endphp

<section class="max-w-6xl mx-auto px-5 lg:px-8 pb-20 lg:pb-28">
    <div class="site-grain relative rounded-[2.5rem] bg-brand-dark text-ivory px-8 py-14 lg:py-16 text-center overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(184,146,74,0.18),_transparent_60%)]"></div>
        <div class="relative">
            <span class="site-rule mx-auto mb-6"></span>
            <h2 class="font-display text-3xl sm:text-4xl font-medium leading-tight max-w-2xl mx-auto">
                {{ $section->getTranslation('heading', $locale) }}
            </h2>
            @if($section->getTranslation('body', $locale))
                <p class="mt-4 text-ivory/75 max-w-xl mx-auto leading-relaxed">{{ $section->getTranslation('body', $locale) }}</p>
            @endif

            @if($item?->link_url)
                <a href="{{ $item->link_url }}"
                   class="mt-9 inline-flex items-center gap-2 h-12 px-8 rounded-full bg-gold text-brand-dark font-display font-semibold tracking-wide hover:bg-gold-light transition-colors shadow-lg">
                    {{ $item->getTranslation('link_label', $locale) }}
                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            @endif
        </div>
    </div>
</section>
