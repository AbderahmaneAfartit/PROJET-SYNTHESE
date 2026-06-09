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

    public function services(): View
    {
        $services = \App\Models\Service::with(['posts.user', 'users'])->get();
        return view('pages.services', [
            'services' => $services,
        ]);
    }

    public function posts(): View
    {
        $posts = \App\Models\Post::with(['user', 'service'])->latest()->get();
        return view('pages.posts', [
            'posts' => $posts,
        ]);
    }

    public function ajoutPost(): View
    {
        $services = \App\Models\Service::all();
        return view('pages.ajout-post', [
            'services' => $services,
        ]);
    }

    public function storePost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'service_id' => ['nullable', 'exists:services,id'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:10240'],
        ]);

        // Use the user's own service_id (from form hidden field or their profile)
        $serviceId = $validated['service_id'] ?? auth()->user()->service_id;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        \App\Models\Post::create([
            'user_id' => auth()->id(),
            'service_id' => $serviceId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('posts')
            ->with('success', 'Post publié avec succès !');
    }
}
