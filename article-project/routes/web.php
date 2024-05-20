<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
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

// 管理者ルート
Route::middleware('guest')->group(function () {

    // 管理者ログイン2段階認証
    Route::get('admin/first-auth', [AdminController::class, 'sendPassEmail'])
        ->name('adminfirst-auth'); // 追加

    /**
     **トークンを含んだメールを送信するルーティング
     */
    Route::post('admin/sendTokenEmail', [AdminController::class, 'sendTokenEmail'])
        ->name('adminsendTokenEmail');
    /**
     *
     */
    Route::post('', [AdminController::class, 'auth'])
    ->name('adminauth');



    //管理者ログイン
    Route::get('admin/login', [AdminController::class, 'create'])->name('adminlogin');
    Route::post('admin/login', [AdminController::class, 'store'])->name('adminlogin'); //追加
});

Route::middleware('adminauth')->group(function () {
    // 管理者ログアウト
    Route::post('admin/logout', [AdminController::class, 'destroy'])->name('adminlogout');

    // 管理者TOPページ
    Route::get('/admin/top', function () {
        return view('admin.top');
    })->name('admintop');

    // 管理者TOP
    Route::post('/admin/top', function () {
        return view('admin.top');
    })->name('admintop');

    // 管理者お知らせリスト
    Route::get('/admin/alluser/message/list', [AdminController::class, 'allusermessagelist'])->name('allusermessagelist');
    // 管理者お知らせ新規作成
    Route::get('/admin/alluser/message/create', [AdminController::class, 'allusermessagecreate'])->name('allusermessagecreate');
    // 管理者お知らせ新規作成確認
    Route::post('/admin/alluser/message/create/conf', [AdminController::class, 'allusermessagecreateconf'])->name('allusermessagecreateconf');
    // 管理者お知らせ新規作成登録
    Route::post('/admin/alluser/message/create/store', [AdminController::class, 'allusermessagecreatestore'])->name('allusermessagecreatestore');
    // 管理者お知らせ個別表示
    Route::post('/admin/alluser/message/show', [AdminController::class, 'allusermessageshow'])->name('allusermessageshow');
    // 管理者お知らせ編集
    Route::post('/admin/alluser/message/update', [AdminController::class, 'allusermessageupdate'])->name('allusermessageupdate');
    // 管理者お知らせ編集確認
    Route::post('/admin/alluser/message/update/conf', [AdminController::class, 'allusermessageupdateconf'])->name('allusermessageupdateconf');
     // 管理者お知らせ編集完了
     Route::patch('', [AdminController::class, 'allusermessageupdatecomplete'])->name('allusermessageupdatecomplete');

});

// ユーザールート
Route::get('/', function () {
    return view('welcome');
});

Route::get('/quit', function () {
    return view('quit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//　お知らせ表示
// Route::prefix('announcement')->middleware('auth')->group(function(){
//     // ページ上部にお知らせを表示
//     Route::get('/', [AnnouncementController::class, 'index'])->name('announcement.index');
//     // 未読のお知らせデータを取得
//     Route::get('/list', [AnnouncementController::class, 'list'])->name('announcement.list');
//     // お知らせの詳細
//     Route::get('/{announcement}', [AnnouncementController::class, 'show'])->name('announcement.show');

// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/delete_questionnaire', [ProfileController::class, 'delete_questionnaire'])->name('delete_questionnaire');
    Route::get('/questionnaire_conf', [ProfileController::class, 'questionnaire_conf'])->name('questionnaire_conf');
    Route::post('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/open_profile', [ProfileController::class, 'open_profile'])->name('open_profile');
    Route::post('/open_profile', [ProfileController::class, 'open_profile_store'])->name('open_profile_store');
});

require __DIR__.'/auth.php';
