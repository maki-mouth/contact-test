<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::get('/', [ContactController::class, 'index'])->name('contact.index');       // フォーム初期表示
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm'); // 確認画面（セッション保存）
Route::post('/thanks', [ContactController::class, 'send'])->name('contact.send'); // 最終送信・保存
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks'); // (リダイレクト用。または send() がビューを直接返す場合は不要)

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [ContactController::class, 'admin'])->name('admin');
});

Route::delete('/admin/contact/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');