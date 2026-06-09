<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ContactMessageService;
use App\Services\FrontendContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function __construct(
        private readonly FrontendContentService $contentService,
        private readonly ContactMessageService $contactMessageService,
    ) {
    }

    public function home(): View
    {
        return view('pages.home', $this->contentService->home());
    }

    public function about(): View
    {
        return view('pages.about', $this->contentService->about());
    }

    public function contact(): View
    {
        return view('pages.contact', $this->contentService->contact());
    }

    public function sendContact(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'subject' => ['required', 'string', 'max:80'],
            'message' => ['required', 'string', 'min:20', 'max:1000'],
        ]);

        $this->contactMessageService->store($data);

        return redirect()
            ->route('contact')
            ->with('contact_sent', true);
    }

    public function providers(): View
    {
        $providers = User::query()
            ->where('role', 'manjob')
            ->with('clientJobs')
            ->get();

        return view('pages.providers', [
            'providers' => $providers,
        ]);
    }
}
