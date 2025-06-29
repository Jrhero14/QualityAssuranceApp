<?php

use App\Livewire\Checking;
use App\Livewire\DashboardPage;
use App\Livewire\HomePage;
use App\Livewire\ItemsView;
use App\Livewire\LaporanQA;
use App\Livewire\LoginPage;
use App\Livewire\UserCreate;
use App\Livewire\UserEdit;
use App\Livewire\UsersIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/login', LoginPage::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');

    Route::get('/logout', function (Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');


    // Staff URLS
    Route::get('/checking', Checking::class)->name('checking');

    // Supervisor URLS
    Route::get('/laporan-qa', LaporanQA::class)->middleware('isSupervisor')->name('laporan-qa');
    Route::get('/items-database', ItemsView::class)->middleware('isSupervisor')->name('items-database');
    Route::post('/items-database', [ItemsView::class, 'save'])->middleware('isSupervisor')->name('items-database');
    Route::middleware(['auth', 'isSupervisor'])->group(function () {
        Route::get('/admin/users', UsersIndex::class)->name('users.index');
        Route::get('/admin/users/create', UserCreate::class)->name('users.create');
        Route::get('/admin/users/{user}/edit', UserEdit::class)->name('users.edit');
    });
});
