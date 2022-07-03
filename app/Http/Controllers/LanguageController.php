<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    //
    public function swap($locale)
    {
        // available language in template array
        $availLocale = ['en'=>'en', 'id'=>'id'];
        // check for existing language
        if (array_key_exists($locale, $availLocale)) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
