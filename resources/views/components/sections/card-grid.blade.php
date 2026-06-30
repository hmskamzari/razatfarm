@php
    $locale = app()->getLocale();
    $count = $section->items->count();
    $cols = $count >= 4 ? 'lg:grid-cols-4' : ($count === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2');
@endphp

<section class="max-w-7xl mx-auto px-5 lg:px-8 py-16 lg:py-20">
    @if($section->getTranslation('heading', $locale))
        <div class="reveal-up max-w-3xl mx-auto text-center mb-14">
            <span class="site-rule mx-auto mb-5"></span>
            <h2 class="font-display text-3xl sm:text-4xl text-brand-dark font-medium leading-tight">
                {{ $section->getTranslation('heading', $locale) }}
            </h2>
            @if($section->getTranslation('body', $locale))
                <p class="mt-4 text-ink/65 leading-relaxed">{{ $section->getTranslation('body', $locale) }}</p>
            @endif
        </div>
    @endif

    <div class="grid sm:grid-cols-2 {{ $cols }} gap-6 lg:gap-7">
        @foreach($section->items as $i => $item)
            <div class="reveal-up group rounded-3xl bg-white ring-1 ring-brand/8 shadow-sm hover:shadow-2xl hover:shadow-brand-dark/10 transition-shadow overflow-hidden flex flex-col">
                @if($item->image)
                    <div class="h-44 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" alt=""
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                @else
                    <div class="pt-7 px-7">
                        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-brand/8 text-brand font-display font-semibold">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                @endif

                <div class="p-7 flex-1 flex flex-col">
                    <h3 class="font-display text-lg text-brand-dark font-semibold">
                        {{ $item->getTranslation('heading', $locale) }}
                    </h3>
                    @if($item->getTranslation('body', $locale))
                        <p class="mt-2.5 text-ink/65 text-sm leading-relaxed">{{ $item->getTranslation('body', $locale) }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
