@props(['section', 'index' => 0])

@switch($section->type)
    @case('hero_slider')
        @include('components.sections.hero-slider', ['section' => $section])
        @break

    @case('icon_features')
        @include('components.sections.icon-features', ['section' => $section])
        @break

    @case('intro')
        @include('components.sections.intro', ['section' => $section])
        @break

    @case('content_block')
        @include('components.sections.content-block', ['section' => $section, 'index' => $index])
        @break

    @case('card_grid')
        @include('components.sections.card-grid', ['section' => $section])
        @break

    @case('stats')
        @include('components.sections.stats', ['section' => $section])
        @break

    @case('cta')
        @include('components.sections.cta', ['section' => $section])
        @break

    @case('terms_list')
        @include('components.sections.terms-list', ['section' => $section])
        @break
@endswitch
