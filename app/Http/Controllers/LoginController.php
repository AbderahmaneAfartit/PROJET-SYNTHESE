<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function Showlogin(): View
    {
        return view('pages.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        // Validation simple des champs envoyes par le formulaire de connexion.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Laravel verifie l'email et le mot de passe dans la table users.
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['form' => 'Email ou mot de passe incorrect.'])
                ->onlyInput('email');
        }

        // On regenere la session pour proteger l'utilisateur apres connexion.
        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('success', 'Connexion reussie.');
    }

    public function logout(Request $request): RedirectResponse
    {
        // Deconnexion de l'utilisateur connecte.
        Auth::logout();

        // Nettoyage de la session pour eviter les anciennes sessions actives.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Deconnexion reussie.');
    }
}
