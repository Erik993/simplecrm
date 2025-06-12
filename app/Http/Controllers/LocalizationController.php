<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LocalizationController extends Controller
{
    //Save selected language to the session and redirect to previous page
    public function switch($locale)
    {
        if (! in_array($locale, ['en', 'lv'])) {
            abort(400);
        }
        /*
        Session::put('locale', $locale);
        App::setLocale($locale);*/

        Session::put('locale', $locale);
        return redirect()->back();
    }
}
