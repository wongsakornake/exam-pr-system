<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\PublicRelationController;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('home');


Route::get('customer/public-relations/create', [PublicRelationController::class, 'create'])->name('createPR');


Route::get('/internal-api/target-media-receivers', [PublicRelationController::class, 'getReceiversByArea'])
    ->name('internal.receivers.index');

Route::post('customer/public-relations', [PublicRelationController::class, 'store'])->name('public-relations.store');

Route::get('admin/public-relations/review', [PublicRelationController::class, 'review'])
    ->name('public-relations.review');

Route::get('customer/public-relations/list', [PublicRelationController::class, 'list'])
    ->name('public-relations.list');

Route::get('customer/public-relations/edit', [PublicRelationController::class, 'edit'])
    ->name('public-relations.edit');

// Route::get('customer/public-relations/create', [PublicRelationController::class, 'create'])->name('createPR');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('example/send-email', function () {
    return Inertia::render('example/SendEmail', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('examSendEmail');


use App\Http\Controllers\EmailController;
Route::post('/send-email', [EmailController::class, 'send'])->name('email.send');

require __DIR__.'/settings.php';













// use App\Http\Controllers\PublicRelationController;
// use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;

// // --- ส่วนของ Admin ---
// Route::middleware(['auth', 'role:admin']) // ใช้ Middleware กรองสิทธิ์
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
        
//         Route::get('public-relations/review', [PublicRelationController::class, 'review'])
//             ->name('pr.review'); // ชื่อเต็มคือ admin.pr.review
            
//     });

// // --- ส่วนของ Customer ---
// Route::middleware(['auth', 'role:customer'])
//     ->prefix('customer')
//     ->name('customer.')
//     ->group(function () {
        
//         Route::get('public-relations/list', [PublicRelationController::class, 'index'])
//             ->name('pr.list'); // ชื่อเต็มคือ customer.pr.list
            
//         Route::get('public-relations/create', [PublicRelationController::class, 'create'])
//             ->name('pr.create');
            
//     });














// use App\Http\Controllers\PublicRelationController;
// use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;

// // --- ส่วนของ Admin ---
// Route::middleware(['auth', 'role:admin']) // ใช้ Middleware กรองสิทธิ์
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
        
//         Route::get('public-relations/review', [PublicRelationController::class, 'review'])
//             ->name('pr.review'); // ชื่อเต็มคือ admin.pr.review
            
//     });

// // --- ส่วนของ Customer ---
// Route::middleware(['auth', 'role:customer'])
//     ->prefix('customer')
//     ->name('customer.')
//     ->group(function () {
        
//         Route::get('public-relations/list', [PublicRelationController::class, 'index'])
//             ->name('pr.list'); // ชื่อเต็มคือ customer.pr.list
            
//         Route::get('public-relations/create', [PublicRelationController::class, 'create'])
//             ->name('pr.create');
            
//     });
