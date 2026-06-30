@php $locale = app()->getLocale(); @endphp

<section class="max-w-3xl mx-auto px-5 lg:px-8 py-12 lg:py-16">
    <div class="reveal-up">
        <span class="site-rule mb-5"></span>
        <h2 class="font-display text-2xl sm:text-3xl text-brand-dark font-medium leading-tight mb-8">
            {{ $section->getTranslation('heading', $locale) }}
        </h2>

        <div class="site-terms text-ink/75 text-[15px]">
            {!! $section->getTranslation('body', $locale) !!}
        </div>
    </div>
</section>
