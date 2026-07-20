<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\LayananController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK (tanpa login) — bisa diakses semua warga
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-desa', [HomeController::class, 'profil'])->name('profil');

Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});

Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/', [LayananController::class, 'index'])->name('index');
    Route::get('/ajukan/{jenisSurat}', [LayananController::class, 'form'])->name('form');
    Route::post('/ajukan', [LayananController::class, 'store'])->name('store');
    Route::get('/sukses/{kode}', [LayananController::class, 'sukses'])->name('sukses');
    Route::get('/cek-status', [LayananController::class, 'cekStatusForm'])->name('cek-status');
    Route::post('/cek-status', [LayananController::class, 'cekStatus'])->name('cek-status.submit');
});

/*
|--------------------------------------------------------------------------
| AUTENTIKASI ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->onlyInput('email');
})->middleware('guest')->name('login.submit');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| PANEL ADMIN (butuh login)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('penduduk', PendudukController::class);

    Route::get('surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('surat/{surat}', [SuratController::class, 'show'])->name('surat.show');
    Route::patch('surat/{surat}/status', [SuratController::class, 'updateStatus'])->name('surat.status');

    Route::resource('jenis-surat', JenisSuratController::class)->parameters(['jenis-surat' => 'jenissurat']);

    Route::resource('berita', AdminBeritaController::class);
});
