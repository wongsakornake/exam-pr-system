<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('home');

Route::get('admin/public-relations/review', function () {
    return Inertia::render('public-relations/review', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('reviewPR');

Route::get('customer/public-relations/list', function () {
    return Inertia::render('public-relations/list', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('listPR');

Route::get('customer/public-relations/create', function () {
    return Inertia::render('public-relations/create', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('createPR');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
