@props(['siteSetting' => null, 'title' => null, 'metaDescription' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="site">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Razat Royal Farm') }}</title>
    @if(isset($metaDescription) && $metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endif

    <link rel="icon" href="{{ asset('storage/images/horizontalLogo-02.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Work+Sans:wght@400;500;600;700&family=El+Messiri:wght@500;600;700&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/site.css', 'resources/js/site.js'])
    @livewireStyles
</head>
<body class="site bg-ivory text-ink antialiased">

    <header class="sticky top-0 z-50 bg-ivory/90 backdrop-blur border-b border-brand/10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('storage/images/horizontalLogo-02.png') }}" alt="{{ config('app.name') }}" class="h-12 w-auto">
                </a>

                <nav class="hidden lg:flex items-center gap-9 font-display text-[15px] tracking-wide">
                    <a href="{{ route('home') }}" class="text-ink/80 hover:text-brand transition-colors {{ request()->routeIs('home') ? 'text-brand' : '' }}">{{ __('site.nav.home') }}</a>
                    <a href="{{ route('page.about') }}" class="text-ink/80 hover:text-brand transition-colors {{ request()->routeIs('page.about') ? 'text-brand' : '' }}">{{ __('site.nav.about') }}</a>
                    <a href="{{ route('page.visit-terms') }}" class="text-ink/80 hover:text-brand transition-colors {{ request()->routeIs('page.visit-terms') ? 'text-brand' : '' }}">{{ __('site.nav.terms') }}</a>
                    <a href="{{ route('events.index') }}" class="text-ink/80 hover:text-brand transition-colors {{ request()->routeIs('events.index') || request()->routeIs('event.booking') ? 'text-brand' : '' }}">{{ __('site.nav.bookings') }}</a>
                    <a href="{{ route('page.contact') }}" class="text-ink/80 hover:text-brand transition-colors {{ request()->routeIs('page.contact') ? 'text-brand' : '' }}">{{ __('site.nav.contact') }}</a>
                </nav>

                <div class="flex items-center gap-3">
                    @if($siteSetting?->phone_primary)
                        <a href="tel:{{ $siteSetting->phone_primary }}" class="hidden md:inline-flex items-center gap-2 text-sm text-ink/70 hover:text-brand transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.95.68l1.2 3.6a1 1 0 01-.27 1.05l-1.6 1.6a11.05 11.05 0 005.5 5.5l1.6-1.6a1 1 0 011.05-.27l3.6 1.2a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.16 21 3 14.84 3 7V6z"/></svg>
                            {{ $siteSetting->phone_primary }}
                        </a>
                    @endif

                    <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                       class="hidden sm:inline-flex items-center justify-center h-9 px-3.5 rounded-full border border-brand/25 text-xs font-semibold tracking-wide text-brand hover:bg-brand hover:text-ivory transition-colors">
                        {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                    </a>

                    <a href="{{ route('events.index') }}"
                       class="hidden sm:inline-flex items-center h-10 px-5 rounded-full bg-brand text-ivory text-sm font-semibold tracking-wide hover:bg-brand-dark transition-colors shadow-sm shadow-brand/30">
                        {{ __('site.nav.book_now') }}
                    </a>

                    <button data-nav-toggle class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-full border border-brand/20 text-brand">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>

            <div data-mobile-nav class="hidden lg:hidden pb-6 flex flex-col gap-4 font-display text-base">
                <a href="{{ route('home') }}" class="text-ink/80 hover:text-brand">{{ __('site.nav.home') }}</a>
                <a href="{{ route('page.about') }}" class="text-ink/80 hover:text-brand">{{ __('site.nav.about') }}</a>
                <a href="{{ route('page.visit-terms') }}" class="text-ink/80 hover:text-brand">{{ __('site.nav.terms') }}</a>
                <a href="{{ route('events.index') }}" class="text-ink/80 hover:text-brand">{{ __('site.nav.bookings') }}</a>
                <a href="{{ route('page.contact') }}" class="text-ink/80 hover:text-brand">{{ __('site.nav.contact') }}</a>
                <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="text-gold font-semibold">{{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}</a>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="site-grain relative bg-brand-dark text-ivory mt-24 overflow-hidden">
        <svg class="site-wave -mt-px" viewBox="0 0 1440 64" preserveAspectRatio="none"><path fill="currentColor" d="M0,32 C240,64 480,0 720,16 C960,32 1200,64 1440,32 L1440,0 L0,0 Z"/></svg>

        <div class="max-w-7xl mx-auto px-5 lg:px-8 pb-12 pt-4 relative">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">
                <div>
                    <img src="{{ asset('storage/images/horizontalLogo-02.png') }}" alt="{{ config('app.name') }}" class="h-12 w-auto brightness-0 invert opacity-95 mb-4">
                    <p class="text-ivory/65 text-sm leading-relaxed max-w-xs">{{ __('site.footer.tagline') }}</p>
                </div>

                <div>
                    <h4 class="font-display text-gold-light text-sm tracking-[0.18em] uppercase mb-4">{{ __('site.footer.location') }}</h4>
                    <p class="text-ivory/75 text-sm leading-relaxed whitespace-pre-line">{{ $siteSetting?->getTranslation('address', app()->getLocale()) }}</p>
                </div>

                <div>
                    <h4 class="font-display text-gold-light text-sm tracking-[0.18em] uppercase mb-4">{{ __('site.footer.contact') }}</h4>
                    <ul class="text-ivory/75 text-sm space-y-2">
                        @if($siteSetting?->phone_primary)
                            <li><a href="tel:{{ $siteSetting->phone_primary }}" class="hover:text-gold-light transition-colors">{{ $siteSetting->phone_primary }}</a></li>
                        @endif
                        @if($siteSetting?->email)
                            <li><a href="mailto:{{ $siteSetting->email }}" class="hover:text-gold-light transition-colors">{{ $siteSetting->email }}</a></li>
                        @endif
                    </ul>
                </div>

                <div>
                    <h4 class="font-display text-gold-light text-sm tracking-[0.18em] uppercase mb-4">{{ __('site.footer.hours') }}</h4>
                    <p class="text-ivory/75 text-sm leading-relaxed">{{ $siteSetting?->getTranslation('visit_hours', app()->getLocale()) }}</p>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-ivory/15 text-center text-ivory/55 text-xs tracking-wide">
                {{ $siteSetting?->getTranslation('footer_copyright', app()->getLocale()) }}
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
