<?php

use App\Livewire\Monitors\ContributionsView;
use App\Http\Controllers\Api\V1\MonitorController;
use App\Http\Controllers\Auth\GithubController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', '/home/index')->name('home.index');

Volt::route('/login', 'auth.login');

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
});

Route::get('/auth/github', [GithubController::class,'redirect'])->name('github.login');
Route::get('/auth/github/callback', [GithubController::class,'callback']);

Volt::route('/monitors', 'monitors.index')->name('monitors.index');
Volt::route('/monitors/{monitor}', 'monitors.show')->name('monitors.show');

Volt::route('/custom', "monitors.custom.index")->name('monitors.custom.index');
Volt::route('/custom/{monitor}', "monitors.custom.show")->name('monitors.custom.show');

Volt::route('/monitors/{monitor}/milestones/{milestone}', 'milestones.show')->name('milestone.show');

Volt::route('/monitors/{monitor}/pdf', 'pdf.index')->name('pdf.index');

Route::get('/monitors/{monitor}/contributions/{contribution?}', ContributionsView::class)->lazy();

Volt::route('/create-monitor', 'auth.create-monitor');
Volt::route('/create-open-source-monitor', 'auth.create-open-source-monitor');

Volt::route('/join', 'auth.join-monitor');
Volt::route('/register', 'auth.register');

Volt::route('/repos', 'repositories.list')->name('repositories.list');

Volt::route('/settings/profile', 'settings.index')->name('settings.index');
Volt::route('/settings/monitors', 'settings.monitors.index')->name('settings.monitors.index');

Route::get('/monitors/join/{monitor_hash}', [MonitorController::class, 'join']);
