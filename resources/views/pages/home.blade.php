<x-layouts.site :site-setting="$siteSetting" :title="$page->getTranslation('title', app()->getLocale()) . ' — ' . config('app.name')" :meta-description="$page->getTranslation('meta_description', app()->getLocale())">

    @foreach($page->sections as $section)
        @if($section->type === 'cta')
            @include('pages.partials.upcoming-visits', ['events' => $upcomingEvents])
        @endif

        <x-section :section="$section" :index="$loop->index" />
    @endforeach

</x-layouts.site>
