<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/event/{uniq_id}',[EventController::class, 'showevent']);
//Route::post('/event/{uniq_id}/resadate/{date}',[EventController::class, 'showevent']);

//Route::post('/event/{uniq_id}/setdate',[EventController::class, 'placeDate']);
Route::get('/mailable/{uniq_id}', function ($uniq_id) {
    $event = App\Models\Event::where('id_unique',$uniq_id)->first();
    return new App\Mail\EventMailDuJour($event);
});