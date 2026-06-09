<?php

namespace App\Services;

use App\Models\ClientJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthSessionService
{
    public function login(Request $request, array $credentials): bool
    {
        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            return false;
        }

        $request->session()->regenerate();

        return true;
    }

    public function register(Request $request, array $data): User
    {
        return DB::transaction(function () use ($request, $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $request->boolean('travailleur') ? 'manjob' : 'client',
            ]);

            if ($request->boolean('travailleur')) {
                $jobs = collect($data['jobs'] ?? [])
                    ->filter(fn ($job) => filled($job))
                    ->map(fn ($job) => trim((string) $job))
                    ->unique()
                    ->values();

                if ($jobs->isEmpty()) {
                    throw ValidationException::withMessages([
                        'jobs.0' => 'Please add at least one job.',
                    ]);
                }

                foreach ($jobs as $job) {
                    ClientJob::create([
                        'user_id' => $user->id,
                        'title' => $job,
                    ]);
                }
            }

            Auth::login($user);
            $request->session()->regenerate();

            return $user->load('clientJobs');
        });
    }

    public function logout(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
