@php $locale = app()->getLocale(); @endphp

<x-layouts.site :site-setting="$siteSetting" :title="$page->getTranslation('title', $locale) . ' — ' . config('app.name')" :meta-description="$page->getTranslation('meta_description', $locale)">

    <section class="site-grain relative bg-brand-dark text-ivory pt-28 pb-16 lg:pt-36 lg:pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,_rgba(184,146,74,0.18),_transparent_55%)]"></div>
        <div class="relative max-w-5xl mx-auto px-5 lg:px-8 text-center">
            <span class="site-rule mx-auto mb-6"></span>
            <h1 class="font-display text-4xl sm:text-5xl font-medium">{{ $page->getTranslation('title', $locale) }}</h1>
        </div>
    </section>

    @foreach($page->sections as $section)
        <x-section :section="$section" :index="$loop->index" />
    @endforeach

    @if($page->slug === 'contact')
        @include('pages.partials.contact-form')
    @endif

</x-layouts.site>
