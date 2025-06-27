<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminDivisiController;
use App\Http\Controllers\AdminPengaturanController;
use App\Http\Controllers\WelcomeController;

// Halaman utama
Route::get('/', [WelcomeController::class, 'index']);

// Route untuk pendaftaran (user)
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// Route untuk verifikasi admin
Route::get('/admin/verify', function () {
    return view('admin.verify');
})->name('admin.verify');

Route::post('/admin/verify', function () {
    $password = request('password');
    if ($password === 'adminukmimam2025') {
        session(['admin_verified' => true]);
        return redirect('/admin/divisi');
    } else {
        return back()->withErrors(['password' => 'Password salah!']);
    }
})->name('admin.verify.post');

// Route untuk admin (memerlukan verifikasi)
Route::middleware(['admin.verified'])->prefix('admin')->group(function () {
    Route::get('/divisi', [AdminDivisiController::class, 'index'])->name('admin.divisi.index');
    Route::get('/divisi/create', [AdminDivisiController::class, 'create'])->name('admin.divisi.create');
    Route::post('/divisi', [AdminDivisiController::class, 'store'])->name('admin.divisi.store');
    Route::get('/divisi/{divisi}/edit', [AdminDivisiController::class, 'edit'])->name('admin.divisi.edit');
    Route::put('/divisi/{divisi}', [AdminDivisiController::class, 'update'])->name('admin.divisi.update');
    Route::delete('/divisi/{divisi}', [AdminDivisiController::class, 'destroy'])->name('admin.divisi.destroy');
    
    // Route untuk pengaturan acara
    Route::get('/pengaturan', [AdminPengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::put('/pengaturan', [AdminPengaturanController::class, 'update'])->name('admin.pengaturan.update');
});

// Route untuk logout admin
Route::post('/admin/logout', function () {
    session()->forget('admin_verified');
    return redirect('/');
})->name('admin.logout');

