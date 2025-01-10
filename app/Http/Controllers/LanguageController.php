<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;


class LanguageController extends Controller
{
    public function switch($locale): RedirectResponse
    {
        if (!in_array($locale, ['en', 'id'])) {
            abort(400);
        }

        // Store the selected locale in the database for the user (you are already doing this)
        auth()->user()->update(['language' => $locale]);

        session()->put('locale', $locale);
        
        App::setLocale($locale);

        return redirect()->route('home');
    }

}
