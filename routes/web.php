<?php

use App\Livewire\Checking;
use App\Livewire\DashboardPage;
use App\Livewire\ItemsView;
use App\Livewire\LaporanQA;
use App\Livewire\LoginPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return redirect('/login');
})->middleware('auth');

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

});
