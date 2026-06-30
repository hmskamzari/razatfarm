@php $locale = app()->getLocale(); @endphp

<section class="max-w-4xl mx-auto px-5 lg:px-8 pt-20 pb-4 text-center">
    @if($section->getTranslation('heading', $locale))
        <h2 class="reveal-up font-display text-3xl sm:text-4xl text-brand-dark font-medium leading-tight">
            {{ $section->getTranslation('heading', $locale) }}
        </h2>
        <span class="site-rule mx-auto my-6"></span>
    @endif

    @if($section->getTranslation('body', $locale))
        <p class="reveal-up text-ink/70 text-lg leading-relaxed whitespace-pre-line">
            {{ $section->getTranslation('body', $locale) }}
        </p>
    @endif
</section>
