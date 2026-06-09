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
        return view('pages.auth.signup');
    }

    public function register(Request $request): RedirectResponse
    {
        // Validation des informations principales du nouveau compte.
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'travailleur' => ['nullable', 'boolean'],
            'jobs' => ['nullable', 'array'],
            'jobs.*' => ['nullable', 'string', 'max:255'],
        ]);

        // Si le compte est travailleur, au moins un metier doit etre renseigne.
        $jobs = collect($data['jobs'] ?? [])
            ->map(fn ($job) => trim((string) $job))
            ->filter()
            ->unique()
            ->values();

        if ($request->boolean('travailleur') && $jobs->isEmpty()) {
            return back()
                ->withErrors(['jobs.0' => 'Ajoutez au moins un metier.'])
                ->withInput();
        }

        $user = DB::transaction(function () use ($request, $data, $jobs) {
            // Creation de l'utilisateur dans la table users existante.
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $request->boolean('travailleur') ? 'manjob' : 'client',
            ]);

            // Creation des metiers dans client_jobs pour les comptes travailleurs.
            foreach ($jobs as $job) {
                ClientJob::create([
                    'user_id' => $user->id,
                    'title' => $job,
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
