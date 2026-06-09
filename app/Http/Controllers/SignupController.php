<?php

namespace App\Http\Controllers;

use App\Models\ClientJob;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SignupController extends Controller
{
    public function Showsigne(): View
    {
        return view('pages.auth.signup', ['posts' => \App\Models\Post::all()]);
    }

    public function register(Request $request): RedirectResponse
    {
        // Validation des informations principales du nouveau compte.
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'travailleur' => ['nullable', 'boolean'],
            'post_id' => ['nullable', 'exists:posts,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'contact' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'max:10240'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
        }

        $user = DB::transaction(function () use ($request, $data, $imagePath) {
            // Creation de l'utilisateur dans la table users existante.
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $request->boolean('travailleur') ? 'manjob' : 'client',
                'contact' => $data['contact'] ?? null,
                'image' => $imagePath,
                'service_id' => $request->boolean('travailleur') ? ($data['service_id'] ?? null) : null,
            ]);

            // Si le compte est travailleur et un post est selectionné, créer le job.
            if ($request->boolean('travailleur') && $request->filled('post_id')) {
                $post = \App\Models\Post::find($request->post_id);
                ClientJob::create([
                    'user_id' => $user->id,
                    'title' => $post->title,
                    'status' => 'open',
                ]);
            }

            return $user;
        });

        // Connexion automatique apres inscription.
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('success', 'Compte cree avec succes.');
    }
}
