<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $page = Page::published()->where('slug', 'home')->with('sections.items')->firstOrFail();
        $upcomingEvents = Event::published()->upcoming()->orderBy('start_date')->take(3)->get();

        return view('pages.home', [
            'page' => $page,
            'upcomingEvents' => $upcomingEvents,
            'siteSetting' => SiteSetting::current(),
        ]);
    }

    public function show(string $slug): View
    {
        $page = Page::published()->where('slug', $slug)->with('sections.items')->firstOrFail();

        return view('pages.show', [
            'page' => $page,
            'siteSetting' => SiteSetting::current(),
        ]);
    }
}
