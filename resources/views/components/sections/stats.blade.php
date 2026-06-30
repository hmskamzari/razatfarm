@php $locale = app()->getLocale(); @endphp

<section class="site-grain relative bg-brand text-ivory py-16 lg:py-20 overflow-hidden">
    <svg class="site-wave site-wave-brand absolute -top-px left-0 rotate-180" viewBox="0 0 1440 64" preserveAspectRatio="none"><path fill="currentColor" d="M0,32 C240,64 480,0 720,16 C960,32 1200,64 1440,32 L1440,0 L0,0 Z"/></svg>

    <div class="relative max-w-6xl mx-auto px-5 lg:px-8 grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6 text-center">
        @foreach($section->items as $item)
            <div class="reveal-up">
                <p class="font-display text-4xl sm:text-5xl font-semibold text-gold-light">{{ $item->value }}</p>
                <p class="mt-2 text-ivory/75 text-sm tracking-wide">{{ $item->getTranslation('heading', $locale) }}</p>
            </div>
        @endforeach
    </div>
</section>
