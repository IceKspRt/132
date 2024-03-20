<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\C_titles;
use App\Http\Controllers\MyAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MyController;
use App\Http\Controllers\TagController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome'); // welcome.blade.php
});

Route::get('/my-route',function(){
    return view('myfolder.mypage');
});

Route::get('/home',function(){
    return view('home');
});


Route::post('/my-page', function(Request $req) {
    $req->validate([
        'back' => 'required|string',
    ]);
    $data['back'] = $req->input('back');
    return view('back', $data);
});

Route::post('logout', function () {
    Auth::logout();
    return redirect('login'); // Redirect to the desired page after logout
})->name('logout');


Route::get('/login', [MyAuth::class, 'login_view'])->name('login');
Route::get('/register', [MyAuth::class, 'register_view']);
Route::get('/logout', [MyAuth::class, 'logout_process']);
Route::post('/login', [MyAuth::class, 'login_process']);
Route::post('/register', [MyAuth::class, 'register_process']);

// Route::resource('titles', C_titles::class)->middleware('auth');
// Route::middleware('auth')->group(function () {
//     // auth first
// });

Route::get('/my-controller', [MyController::class, 'index']);
Route::get('/my-controller2', 'App\Http\Controllers\MyController@index');

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/my-controller3', 'MyController@index');
    Route::get('/my-controller3-post', 'MyController@store');
});
Route::resource('/my-controller4', MyController::class);

Route::get('/', function () {
    return view('welcome'); // welcome.blade.php
});

// Route::get('students',[UserController::class, 'index'])->middleware('auth');
// Route::middleware('auth')->group(function () {
//     // auth first
// });
Route::get('users',[UserController::class, 'index'])->name('users')->name('users.index');
Route::post('users',[UserController::class, 'store'])->name('users.store');
Route::patch('/users/update/{user_id}', [UserController::class, 'update'])->name('users.update');

Route::get('edit-users/{user_id}',[UserController::class, 'edit']);
Route::delete('delete-users/{user_id}', [UserController::class, 'destroy']);
Route::post('changeStatus', [UserController::class, 'changeStatus'])->name('changeStatus');




// Route สำหรับหน้าจัดการป้ายกำกับ
Route::get('/tags',[TagController::class, 'index']) -> name('tags.index');
Route::post('/tags',[TagController::class, 'store'])-> name('tags.store');
Route::patch('/tags/update/{tag_id}', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag_id}',[TagController::class, 'destroy'])-> name('tags.destroy');




