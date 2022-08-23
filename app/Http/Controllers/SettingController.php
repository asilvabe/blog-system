<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(): View
    {
        $setting = Setting::First();

        return view('about.index', ['setting'=> $setting]);
    }
}
