<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RiskController;
use App\Http\Controllers\RiskOwnerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// route untuk semua auth
Auth::routes();

Route::get('/', fn() => view('welcome'))->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'manageRoles'])->name('admin');
        Route::get('/admin/roles', [AdminController::class, 'manageRoles'])->name('admin.roles');
        Route::post('/admin/roles/create', [AdminController::class, 'createRole'])->name('admin.roles.create');
        Route::put('/admin/roles/{id}/edit', [AdminController::class, 'editRole'])->name('admin.roles.edit');
        Route::delete('/admin/roles/{id}/delete', [AdminController::class, 'deleteRole'])->name('admin.roles.delete');

        Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
        Route::post('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::put('/admin/users/{id}/update', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::delete('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });

    // Operator Routes
    Route::middleware(['role:operator'])->group(function () {
        Route::get('/assets/categories', [OperatorController::class, 'manageAssetCategories'])->name('operator.asset.categories');
        Route::post('/assets/categories/create', [OperatorController::class, 'storeAssetCategory'])->name('operator.asset.categories.create');
        Route::put('/assets/categories/{id}/update', [OperatorController::class, 'updateAssetCategory'])->name('operator.asset.categories.edit');
        Route::delete('/assets/categories/{id}/delete', [OperatorController::class, 'deleteAssetCategory'])->name('operator.asset.categories.delete');

        Route::get('/assets', [OperatorController::class, 'manageAssets'])->name('operator.assets');
        Route::post('/assets/create', [OperatorController::class, 'storeAsset'])->name('operator.assets.create');
        Route::put('/assets/{id}/update', [OperatorController::class, 'updateAsset'])->name('operator.assets.edit');
        Route::delete('/assets/{id}/delete', [OperatorController::class, 'deleteAsset'])->name('operator.assets.delete');

        Route::get('/security-requirements', [OperatorController::class, 'manageSecurityRequirements'])->name('operator.security.requirements');
        Route::post('/security-requirements/create', [OperatorController::class, 'stroreSecurityRequirement'])->name('operator.security.requirements.create');
        Route::put('/security-requirements/{id}/update', [OperatorController::class, 'updateSecurityRequirement'])->name('operator.security.requirements.edit');
        Route::delete('/security-requirements/{id}/delete', [OperatorController::class, 'deleteSecurityRequirement'])->name('operator.security.requirements.delete');
    });

    // Risk Owner Routes
    Route::middleware(['role:risk_owner'])->group(function () {
        Route::get('/dashboard', [RiskOwnerController::class, 'dashboard'])->name('risk.owner.dashboard');

        Route::get('/risk/analysis', [RiskOwnerController::class, 'analyzeRisk'])->name('risk.owner.analyze');
        Route::post('/risk/analysis/create', [RiskOwnerController::class, 'storeAnalyzeRisk'])->name('risk.owner.analyze.create');
        Route::put('/risk/analysis/{id}/update', [RiskOwnerController::class, 'updateAnalyzeRisk'])->name('risk.owner.analyze.update');
        Route::delete('/risk/analysis/{id}/delete', [RiskOwnerController::class, 'deleteAnalyzeRisk'])->name('risk.owner.analyze.delete');

        Route::get('/risk/evaluation', [RiskOwnerController::class, 'evaluateRisk'])->name('risk.owner.evaluate');

        Route::get('/risk/mitigation', [RiskOwnerController::class, 'manageMitigation'])->name('risk.owner.manage');
        Route::post('/risk/mitigation/create', [RiskOwnerController::class, 'storeManageMitigation'])->name('risk.owner.manage.create');
        Route::put('/risk/mitigation/{id}/update', [RiskOwnerController::class, 'updateManageMitigation'])->name('risk.owner.manage.update');
        Route::delete('/risk/mitigation/{id}/delete', [RiskOwnerController::class, 'deleteManageMitigation'])->name('risk.owner.manage.delete');
    });

    // Kepala UPT Routes
    Route::middleware(['role:kepala_upt'])->group(function () {
        Route::get('/risk/profile', [RiskController::class, 'showRiskProfile'])->name('kepala.upt.risk.profile');
    });
});