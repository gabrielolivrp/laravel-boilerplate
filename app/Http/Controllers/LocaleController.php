<?php

namespace App\Http\Controllers;

class LocaleController extends Controller
{
    /**
     * @param string $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(string $locale)
    {
        setAppLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }
}
