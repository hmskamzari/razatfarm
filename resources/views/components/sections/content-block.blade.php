@php
    $locale = app()->getLocale();
    $imageRight = $index % 2 === 0;
@endphp

<section class="max-w-7xl mx-auto px-5 lg:px-8 py-16 lg:py-20">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        @if($section->image)
            <div class="reveal-up relative {{ $imageRight ? 'lg:order-2' : '' }}">
                <div class="absolute -inset-4 border border-gold/40 rounded-[2rem] {{ $imageRight ? '-rotate-2' : 'rotate-2' }} pointer-events-none"></div>
                <img src="{{ asset('storage/' . $section->image) }}" alt=""
                     class="relative rounded-[1.75rem] w-full h-[340px] lg:h-[420px] object-cover shadow-2xl shadow-brand-dark/15">
            </div>
        @endif

        <div class="reveal-up {{ $section->image && $imageRight ? 'lg:order-1' : '' }}">
            <span class="site-rule mb-5"></span>
            <h2 class="font-display text-3xl sm:text-4xl text-brand-dark font-medium leading-tight">
                {{ $section->getTranslation('heading', $locale) }}
            </h2>
            <div class="mt-5 text-ink/70 text-base lg:text-lg leading-relaxed whitespace-pre-line">
                {{ $section->getTranslation('body', $locale) }}
            </div>
        </div>
    </div>
</section>
