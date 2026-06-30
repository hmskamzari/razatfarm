@php $locale = app()->getLocale(); @endphp

<x-layouts.site :site-setting="$siteSetting" :title="__('site.events.title') . ' — ' . config('app.name')">

    <section class="site-grain relative bg-brand-dark text-ivory pt-28 pb-16 lg:pt-36 lg:pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,_rgba(184,146,74,0.18),_transparent_55%)]"></div>
        <div class="relative max-w-5xl mx-auto px-5 lg:px-8 text-center">
            <span class="site-rule mx-auto mb-6"></span>
            <h1 class="font-display text-4xl sm:text-5xl font-medium">{{ __('site.events.title') }}</h1>
            <p class="mt-4 text-ivory/75 max-w-xl mx-auto">{{ __('site.events.subtitle') }}</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-5 lg:px-8 py-16 lg:py-20">
        @if($events->isEmpty())
            <p class="text-center text-ink/60 text-lg">{{ __('site.events.no_events') }}</p>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
                @foreach($events as $event)
                    <a href="{{ route('event.booking', $event->slug) }}"
                       class="reveal-up group rounded-3xl bg-white ring-1 ring-brand/8 shadow-sm hover:shadow-2xl hover:shadow-brand-dark/10 transition-shadow overflow-hidden flex flex-col">
                        @if($event->image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $event->image) }}" alt=""
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                        @endif
                        <div class="p-6 flex-1 flex flex-col">
                            <p class="text-gold text-xs font-semibold tracking-[0.16em] uppercase">
                                {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d M Y') }}
                                @if($event->start_date != $event->end_date)
                                    {{ __('site.events.to') }} {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d M Y') }}
                                @endif
                            </p>
                            <h3 class="mt-2 font-display text-lg text-brand-dark font-semibold">
                                {{ $event->getTranslation('title', $locale) }}
                            </h3>
                            <p class="mt-2 text-ink/60 text-sm leading-relaxed line-clamp-3">{{ $event->getTranslation('description', $locale) }}</p>
                            <span class="mt-4 inline-flex items-center gap-1.5 text-brand text-sm font-semibold">
                                {{ __('site.events.book_now') }}
                                <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

</x-layouts.site>
