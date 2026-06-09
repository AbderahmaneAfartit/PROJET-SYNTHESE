<?php

namespace App\Http\Controllers;

use App\Models\ClientJob;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function signup(Request $request): JsonResponse
    {
        // Validation simple pour creer un compte depuis l'API.
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'travailleur' => ['nullable', 'boolean'],
            'jobs' => ['nullable', 'array'],
            'jobs.*' => ['nullable', 'string', 'max:255'],
        ]);

        $jobs = collect($data['jobs'] ?? [])
            ->map(fn ($job) => trim((string) $job))
            ->filter()
            ->unique()
            ->values();

        if ($request->boolean('travailleur') && $jobs->isEmpty()) {
            return response()->json([
                'message' => 'Ajoutez au moins un metier.',
            ], 422);
        }

        $user = DB::transaction(function () use ($request, $data, $jobs) {
            // Le cast du modele User hash le mot de passe automatiquement.
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $request->boolean('travailleur') ? 'manjob' : 'client',
            ]);

            // On enregistre les metiers du travailleur dans client_jobs.
            foreach ($jobs as $job) {
                ClientJob::create([
                    'user_id' => $user->id,
                    'title' => $job,
                    'status' => 'open',
                ]);
            }

            return $user->load('clientJobs');
        });

        Auth::login($user);

        return response()->json([
            'message' => 'Compte cree avec succes.',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        // Validation des identifiants envoyes par l'API.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Email ou mot de passe incorrect.',
            ], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Connexion reussie.',
            'user' => $request->user()->load('clientJobs'),
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        // Retourne l'utilisateur actuellement connecte.
        return response()->json([
            'user' => $request->user()?->load('clientJobs'),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        // Deconnexion et nettoyage de la session.
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Deconnexion reussie.',
        ]);
    }
}
