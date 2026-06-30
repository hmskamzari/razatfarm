@php $locale = app()->getLocale(); @endphp

<section class="max-w-6xl mx-auto px-5 lg:px-8 pb-20 lg:pb-28">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-14 items-start">

        <div class="reveal-up rounded-[2rem] bg-white ring-1 ring-brand/8 shadow-sm p-8 lg:p-10">
            <h2 class="font-display text-2xl text-brand-dark font-semibold mb-1">{{ __('site.contact.form_title') }}</h2>
            <span class="site-rule mb-7 mt-3"></span>

            @if(session('contact_success'))
                <div class="mb-6 rounded-2xl bg-brand/8 border border-brand/20 text-brand-dark text-sm px-5 py-4">
                    {{ __('site.contact.success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">{{ __('site.contact.name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full h-12 px-4 rounded-xl border border-brand/15 bg-ivory/60 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand transition">
                    @error('name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-ink/70 mb-1.5">{{ __('site.contact.email') }}</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full h-12 px-4 rounded-xl border border-brand/15 bg-ivory/60 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand transition">
                        @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ink/70 mb-1.5">{{ __('site.contact.phone') }}</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="w-full h-12 px-4 rounded-xl border border-brand/15 bg-ivory/60 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand transition">
                        @error('phone')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">{{ __('site.contact.message') }}</label>
                    <textarea name="message" rows="5" required
                              class="w-full px-4 py-3 rounded-xl border border-brand/15 bg-ivory/60 focus:outline-none focus:ring-2 focus:ring-brand/40 focus:border-brand transition">{{ old('message') }}</textarea>
                    @error('message')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 h-12 px-8 rounded-full bg-brand text-ivory font-display font-semibold tracking-wide hover:bg-brand-dark transition-colors shadow-sm">
                    {{ __('site.contact.submit') }}
                </button>
            </form>
        </div>

        <div class="reveal-up space-y-6">
            <div class="rounded-[2rem] overflow-hidden ring-1 ring-brand/8 shadow-sm h-72 lg:h-80">
                @if($siteSetting?->map_embed_url)
                    <iframe src="{{ $siteSetting->map_embed_url }}" class="w-full h-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @endif
            </div>

            <div class="rounded-[2rem] bg-brand text-ivory p-8">
                <h3 class="font-display text-lg font-semibold mb-5">{{ __('site.footer.contact') }}</h3>
                <ul class="space-y-3 text-sm text-ivory/85">
                    @if($siteSetting?->phone_primary)
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.95.68l1.2 3.6a1 1 0 01-.27 1.05l-1.6 1.6a11.05 11.05 0 005.5 5.5l1.6-1.6a1 1 0 011.05-.27l3.6 1.2a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.16 21 3 14.84 3 7V6z"/></svg><a href="tel:{{ $siteSetting->phone_primary }}" class="hover:text-gold-light">{{ $siteSetting->phone_primary }}</a></li>
                    @endif
                    @if($siteSetting?->phone_secondary)
                        <li class="flex items-center gap-3 ps-7"><a href="tel:{{ $siteSetting->phone_secondary }}" class="hover:text-gold-light">{{ $siteSetting->phone_secondary }}</a></li>
                    @endif
                    @if($siteSetting?->email)
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><a href="mailto:{{ $siteSetting->email }}" class="hover:text-gold-light">{{ $siteSetting->email }}</a></li>
                    @endif
                    @if($siteSetting?->getTranslation('address', $locale))
                        <li class="flex items-start gap-3"><svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span class="whitespace-pre-line">{{ $siteSetting->getTranslation('address', $locale) }}</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>
