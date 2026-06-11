<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class ProviderController extends Controller
{
    public function index(): View
    {
        return view('pages.providers', [
            'providers' => User::where('role', 'manjob')->with('clientJobs')->get(),
        ]);
    }
}
