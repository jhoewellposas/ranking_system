<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RankDistributionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //
});

require __DIR__.'/auth.php';

//User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/application/create', [UserController::class, 'createUserApplication'])->name('user.createApplication');
    Route::get('/user/applications', [UserController::class, 'showAllUserApplications'])->name('user.userApplications');
    Route::get('/user/application/{id}', [UserController::class, 'viewApplication'])->name('user.viewApplication');
    // Upload and extract
    Route::post('/user/extract', [UserController::class, 'extractCertificateData'])->name('user.extractCertificateData');
    // Delete a certificate in a ranking application
    Route::delete('/user/certificate/delete/{id}', [UserController::class, 'deleteCertificate'])->name('user.certificate.delete');
    //summary
    Route::get('/user/summary', [UserController::class, 'viewSummary'])->name('user.viewSummary');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/applications', [AdminController::class, 'showAllUsersApplications'])->name('admin.usersApplications');
    Route::get('/admin/application/{id}', [AdminController::class, 'viewApplication'])->name('admin.viewApplication');
    // Update user details in a ranking application
    Route::post('/user/update/{id}', [AdminController::class, 'updateUser'])->name('user.update');
    // Update a certificate in a ranking application
    Route::post('/certificate/update/{id}', [AdminController::class, 'updateCertificate'])->name('certificate.update');
    // Delete a certificate in a ranking application
    Route::delete('/certificate/delete/{id}', [AdminController::class, 'deleteCertificate'])->name('certificate.delete');
    //summary
    Route::get('admin/summary/{id}', [AdminController::class, 'viewSummary'])->name('admin.viewSummary');
    //rank distribution
    Route::get('admin/rankdistributions', [RankDistributionController::class, 'index'])->name('rankDistributions.index');
    Route::post('admin/rankdistributions', [RankDistributionController::class, 'update'])->name('rankDistributions.update');
    //notifications
    Route::post('/notification/read/{id}', [AdminController::class, 'markNotificationAsRead'])->name('notification.read');
});

// Superadmin routes
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
});