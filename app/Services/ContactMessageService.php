<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ContactMessageService
{
    public function store(array $data): void
    {
        Log::info('New contact message', $data);
    }
}
