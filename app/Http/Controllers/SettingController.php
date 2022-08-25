<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Setting;

class SettingController extends Controller
{
    public function show(): View
    {
        $setting = Setting::First();

        return view('about.show', ['setting'=> $setting]);
    }
}
