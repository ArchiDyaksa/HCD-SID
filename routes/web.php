<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesaProfileController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\KontakPentingController as AdminKontakPentingController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\GaleriController as PublicGaleriController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\KegiatanController as PublicKegiatanController;
use App\Http\Controllers\Public\KontakPentingController as PublicKontakPentingController;
use App\Http\Controllers\Public\LayananController;
use App\Models\DesaProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| REDIRECT ROOT KE SLUG DESA TERKINI
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $slug = 'nama-desa';
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('desa_profiles')) {
            $profile = DesaProfile::current();
            $slug = $profile->slug ?: 'nama-desa';
        }
    } catch (\Throwable $e) {}
    return redirect()->route('home', ['desa_slug' => $slug]);
});

/*
|--------------------------------------------------------------------------
| AUTENTIKASI ADMIN & PANEL ADMIN (Daftarkan lebih dahulu agar tidak bentrok dengan {desa_slug})
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
        $user = Auth::user();
        $desaSlug = $user->desaProfile?->slug ?: DesaProfile::current()->slug;
        return redirect()->intended(route('admin.dashboard', ['desa_slug' => $desaSlug]));
    }

    return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->onlyInput('email');
})->middleware('guest')->name('login.submit');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');

Route::prefix('{desa_slug}/admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('penduduk/kk', [PendudukController::class, 'kartuKeluarga'])->name('penduduk.kk');
    Route::resource('penduduk', PendudukController::class);

    Route::get('surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('surat/{surat}', [SuratController::class, 'show'])->name('surat.show');
    Route::patch('surat/{surat}/status', [SuratController::class, 'updateStatus'])->name('surat.status');

    Route::resource('jenis-surat', JenisSuratController::class)->names('jenissurat')->parameters(['jenis-surat' => 'jenissurat']);

    Route::resource('berita', AdminBeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('kegiatan', AdminKegiatanController::class)->parameters(['kegiatan' => 'kegiatan']);
    Route::resource('kontak', AdminKontakPentingController::class)->parameters(['kontak' => 'kontak']);
    Route::resource('galeri', AdminGaleriController::class)->parameters(['galeri' => 'galeri']);

    Route::get('profil', [DesaProfileController::class, 'edit'])->name('profil.edit');
    Route::put('profil', [DesaProfileController::class, 'update'])->name('profil.update');
    Route::delete('profil/logo', [DesaProfileController::class, 'deleteLogo'])->name('profil.delete-logo');
});

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK (tanpa login) — Dinamis Menggunakan Slug Desa
|--------------------------------------------------------------------------
*/
Route::prefix('{desa_slug}')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profil-desa', [HomeController::class, 'profil'])->name('profil');
    Route::get('/agenda-kegiatan', [PublicKegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kontak-penting', [PublicKontakPentingController::class, 'index'])->name('kontak.index');
    Route::get('/galeri-foto', [PublicGaleriController::class, 'index'])->name('galeri.index');

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
        Route::get('/cetak/{kode}', [LayananController::class, 'cetak'])->name('cetak');
    });
});
