<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/login');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('app.home')->with('status', session('status'));
    }

    return redirect()->route('app.home');
});

Route::group(['prefix' => 'app', 'as' => 'app.', 'middleware' => ['auth']], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('events', '\App\Http\Controllers\EventsController');

    Route::get('reminder', [App\Http\Controllers\ReminderController::class, 'index'])->name('reminder.index');

    Route::get('set-reminder/{userId}/{eventId}', [App\Http\Controllers\ReminderController::class, 'setReminder'])->name('reminder.setReminder');
    Route::post('set-reminder/{userId}/{eventId}', [App\Http\Controllers\ReminderController::class, 'updateReminder'])->name('reminder.update');

    Route::get('import-csv', [App\Http\Controllers\ImportCsvController::class, 'index'])->name('import-csv.index');
    Route::post('import-csv', [App\Http\Controllers\ImportCsvController::class, 'importCSV'])->name('import-csv.store');
});