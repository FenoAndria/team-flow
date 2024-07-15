<?php

use App\Http\Controllers\Admin\LeadInvitationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Lead\TeamMemberController;
use App\Http\Controllers\Lead\TeamMemberInvitationController;
use App\Http\Controllers\Lead\TeamNotificationController;
use App\Http\Controllers\Lead\TeamTaskController;
use App\Http\Controllers\Member\MemberNotificationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberSubtaskController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PollingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return response()->json(['message' => 'Bienvenue !']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show'])->name('user-show');
    // User middleware
    Route::middleware('isUser')->group(function () {
        Route::put('/profil', [ProfilController::class, 'update'])->name('profil-update');
    });

    Route::middleware('isAdmin')->group(function () {
        Route::get('/team', [TeamController::class, 'index'])->name('team-index');
        Route::get('/team/{team}', [TeamController::class, 'show'])->name('team-show');
        Route::post('/team', [TeamController::class, 'store'])->name('team-store');

        Route::get('/member', [MemberController::class, 'index'])->name('member-index');

        Route::get('/task', [TaskController::class, 'index'])->name('task-index');
        Route::post('/task', [TaskController::class, 'store'])->name('task-store');

        Route::get('/users', [UserController::class, 'index'])->name('user-index');

        Route::get('/lead-invitation', [LeadInvitationController::class, 'index'])->name('lead-invitation-index');
        Route::post('/lead-invitation', [LeadInvitationController::class, 'store'])->name('lead-invitation-store');
        Route::get('/lead-invitable', [LeadInvitationController::class, 'showInvitableLead'])->name('lead-invitable-show');
    });

    Route::middleware('isLead')->group(function () {
        Route::get('/users-invitable', [TeamController::class, 'showUsersInvitable'])->name('users-invitable-show');
        Route::get('/team-member', [TeamMemberController::class, 'show'])->name('team-member-show');

        Route::get('/team-task', [TeamTaskController::class, 'index'])->name('team-task-index');
        Route::get('/team-task/{task}', [TeamTaskController::class, 'show'])->name('team-task-show');
        Route::post('/subtask/{task}', [SubtaskController::class, 'store'])->name('subtask-store');
        Route::post('/assign-user-subtask/{subtask}', [SubtaskController::class, 'assignUser'])->name('subtask-assign-user');

        Route::get('/team-invitation', [TeamMemberInvitationController::class, 'show'])->name('team-member-invitation-show');
        Route::post('/team-invitation', [TeamMemberInvitationController::class, 'invite'])->name('team-member-invitation-send');

        Route::get('lead-messages', [MessageController::class, 'showLeadMessages'])->name('lead-messages-show');
        Route::post('lead-message', [MessageController::class, 'storeLeadMessage'])->name('lead-message-store');

        Route::get('team-notification', [TeamNotificationController::class, 'show'])->name('team-notification-show');
    });

    Route::middleware('isMember')->group(function () {
        Route::get('/invitation', [InvitationController::class, 'show'])->name('member-invitation-show');
        Route::put('/lead-invitation/{lead_invitation}', [LeadInvitationController::class, 'update'])->name('lead-invitation-update');
        Route::put('/invitation/{team_invitation}', [InvitationController::class, 'update'])->name('team-member-invitation-update');
        Route::post('/leave-team/{team}', [MemberController::class, 'leaveTeam'])->name('member-leave-team');
        Route::get('/member-team', [MemberController::class, 'memberTeams'])->name('member-teams-index');
        Route::get('/member-team/{team}', [MemberController::class, 'showTeam'])->name('member-team-show');

        Route::get('/subtask', [MemberSubtaskController::class, 'index'])->name('member-subtask-show');
        Route::put('/subtask/{subtask}', [MemberSubtaskController::class, 'update'])->name('member-subtask-update');


        Route::get('team-messages/{team}', [MessageController::class, 'showTeamMessages'])->name('team-messages-show');
        Route::post('team-message/{team}', [MessageController::class, 'storeTeamMessage'])->name('team-message-store');

        Route::get('member-notification', [MemberNotificationController::class, 'show'])->name('member-notification-show');
    });

    //Messenger
    Route::get('/long-polling', [PollingController::class, 'poll']);
});

// Authentication
Route::post('/auth/login', [AuthController::class, 'login'])->name('app-login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('app-register');


// Si la route n'existe pas
Route::middleware('api')->any('{any}', function (Request $request) {
    return response()->json(['message' => 'Route not found'], Response::HTTP_NOT_FOUND);
})->where('any', '.*');
