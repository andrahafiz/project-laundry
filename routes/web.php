<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;

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

// Route::get('/api', function () {

//     $curl = curl_init();

//     curl_setopt_array($curl, array(
//         CURLOPT_URL => 'https://api.fonnte.com/send',
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => 'POST',
//         CURLOPT_POSTFIELDS => array(
//             'target' => '082276853382',
//             'url' => 'https://md.fonnte.com/images/logo-dashboard.png',
//             'buttonJSON' => '{"message":"fonnte button message","footer":"fonnte footer message","buttons":[{"id":"mybutton1","message":"hello fonnte"},{"id":"mybutton2","message":"fonnte pricing"},{"id":"mybutton3","message":"tutorial fonnte"}]}',
//             'countryCode' => '62', //optional
//         ),
//         CURLOPT_HTTPHEADER => array(
//             'Authorization: S+n7Qt4fZUkMfjLUI-ZR' //change TOKEN to your actual token
//         ),
//     ));

//     $response = curl_exec($curl);

//     curl_close($curl);
//     echo $response;
// });

Route::controller(FeedbackController::class)->group(
    function () {
        Route::get('/feedback/{feedback:code}',  'create')->name('feedback.create');
        Route::put('/feedback/{feedback:code}',  'store')->name('feedback.update');
    }
);


// if (App::environment('production')) {
//     URL::forceScheme('https');
// }

Route::get('reset', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});

Route::get('/', [AuthController::class, 'login_admin'])->name('login');
Route::post('actionlogin', [AuthController::class, 'actionlogin'])->name('actionlogin');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard-general-dashboard', function () {
    return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
})->middleware(['auth', 'checkRole:ADMIN']);;
Route::get('/dashboard-ecommerce-dashboard', function () {
    return view('pages.dashboard-ecommerce-dashboard', ['type_menu' => 'dashboard']);
});
