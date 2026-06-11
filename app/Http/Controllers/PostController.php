<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('pages.posts', [
            'posts' => Post::with(['user', 'service'])->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('pages.ajout-post', [
            'services' => Service::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'service_id' => ['nullable', 'exists:services,id'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:10240'],
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'service_id' => $validated['service_id'] ?? auth()->user()->service_id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $request->file('image')?->store('posts', 'public'),
        ]);

        return to_route('posts')->with('success', 'Post publie avec succes !');
    }
}
