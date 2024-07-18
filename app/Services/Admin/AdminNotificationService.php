<?php

namespace App\Services\Admin;

use App\Models\AdminNotification;
use App\Traits\TeamTrait;
use Illuminate\Support\Facades\Auth;

class AdminNotificationService
{
    use TeamTrait;
    
    public function show()
    {
        return AdminNotification::latest()->get();
    }
}
