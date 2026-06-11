<?php

namespace App\Http\Controllers;

use App\Services\ContactMessageService;
use App\Services\FrontendContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(FrontendContentService $content): View
    {
        return view('pages.contact', $content->contact());
    }

    public function send(Request $request, ContactMessageService $messages): RedirectResponse
    {
        $messages->store($request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'subject' => ['required', 'string', 'max:80'],
            'message' => ['required', 'string', 'min:20', 'max:1000'],
        ]));

        return to_route('contact')->with('contact_sent', true);
    }
}
