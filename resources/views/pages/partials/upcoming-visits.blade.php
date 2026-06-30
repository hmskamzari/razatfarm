@php $locale = app()->getLocale(); @endphp

@if($events->isNotEmpty())
<section class="max-w-7xl mx-auto px-5 lg:px-8 py-16 lg:py-20">
    <div class="reveal-up max-w-3xl mx-auto text-center mb-14">
        <span class="site-rule mx-auto mb-5"></span>
        <h2 class="font-display text-3xl sm:text-4xl text-brand-dark font-medium leading-tight">{{ __('site.home.upcoming_visits') }}</h2>
        <p class="mt-4 text-ink/65 leading-relaxed">{{ __('site.home.upcoming_visits_subtitle') }}</p>
    </div>

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
                    </p>
                    <h3 class="mt-2 font-display text-lg text-brand-dark font-semibold">
                        {{ $event->getTranslation('title', $locale) }}
                    </h3>
                    <p class="mt-2 text-ink/60 text-sm leading-relaxed line-clamp-2">{{ $event->getTranslation('description', $locale) }}</p>
                    <span class="mt-4 inline-flex items-center gap-1.5 text-brand text-sm font-semibold">
                        {{ __('site.events.book_now') }}
                        <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="reveal-up text-center mt-12">
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 h-11 px-6 rounded-full border border-brand/25 text-brand font-display font-semibold hover:bg-brand hover:text-ivory transition-colors">
            {{ __('site.home.view_all_events') }}
        </a>
    </div>
</section>
@endif
