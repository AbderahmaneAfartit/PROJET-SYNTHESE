<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'service'])->latest()->get();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if user has manjob role
        if (Auth::user()->role !== 'manjob') {
            return response()->json(['message' => 'Unauthorized. Only manjobs can create posts.'], 403);
        }

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $post = Auth::user()->posts()->create($validated);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post->load(['user', 'service']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Ensure user owns the post
        if (Auth::id() !== $post->user_id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $validated = $request->validate([
            'service_id' => 'sometimes|required|exists:services,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|string',
        ]);

        $post->update($validated);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $post->delete();

        return response()->json(null, 204);
    }
}
