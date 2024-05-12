<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Subtask;
use App\Models\Task;
use App\Models\TeamInvitation;
use App\Models\Todo;
use App\Policies\MemberInvitationPolicy;
use App\Policies\SubtaskPolicy;
use App\Policies\TaskPolicy;
use App\Policies\TodoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Todo::class => TodoPolicy::class,
        Task::class => TaskPolicy::class,
        Subtask::class => SubtaskPolicy::class,
        TeamInvitation::class => MemberInvitationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
