<?php

namespace App\Http\Controllers;

use App\Models\ClientJob;
use Illuminate\Http\JsonResponse;

class ClientJobController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'jobs' => ClientJob::with('user:id,name,email,role')->latest()->get(),
        ]);
    }
}
