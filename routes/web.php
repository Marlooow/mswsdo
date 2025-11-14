<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\SocialWorkerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth', 'checkStatus'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:super_admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
        Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
        Route::resource('programs', ProgramController::class);
        Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])->name('superadmin.beneficiaries.index');
        Route::get('/reports', [BeneficiaryController::class, 'reports'])->name('superadmin.reports.index');
        Route::get('/beneficiaries/{beneficiary_id}/application/{application_id}', [UserController::class, 'show'])
            ->name('super_admin.beneficiaries.show');
        // Show beneficiary details with application
        Route::get('/superadmin/beneficiary/{id}/{program_id}', [AdminController::class, 'superadmin_show'])
            ->name('superadmin.beneficiary.show');
    });

    Route::middleware(['role:admin,social_worker'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::middleware(['role:social_worker'])->group(function () {
        Route::get('/social_worker/dashboard', [SocialWorkerController::class, 'index'])->name('social_worker.index');
        Route::get('/social_worker/report', [SocialWorkerController::class, 'generateReport'])->name('social_worker.report');

        Route::get('/social_worker/check-can-apply/{beneficiary_id}', [SocialWorkerController::class, 'checkCanApply'])
            ->name('social_worker.checkCanApply');

        // Updated route for creating a new application
        // Display empty form
        Route::get('/social_worker/form/{program_name}', [SocialWorkerController::class, 'create'])
            ->name('social_worker.form');

        // Display form with beneficiary data
        Route::get('/social_worker/form/{program_name}/{beneficiary_id?}', [SocialWorkerController::class, 'create'])
            ->name('social_worker.create');

        // Single route for viewing a specific beneficiary's application details
        Route::get('/social_worker/beneficiary/{id}/{application_id?}', [SocialWorkerController::class, 'showBeneficiaryApplications'])
            ->name('social_worker.beneficiaries.showBeneficiaryApplications');

        Route::get('/social_worker/store', function () {
            return redirect()->route('social_worker.index')
                ->with('error', 'Invalid access to store route.');
        });
        Route::post('/social_worker/store', [SocialWorkerController::class, 'store'])
            ->name('social_worker.store');

        // Form routes (these may be kept if needed)
        Route::get('/social_worker/form/senior_citizen', [SocialWorkerController::class, 'create'])->name('social_worker.form.senior_citizen');
        Route::get('/social_worker/form/solo_parent', [SocialWorkerController::class, 'create'])->name('social_worker.form.solo_parent');
        Route::get('/social_worker/form/educational_assistance', [SocialWorkerController::class, 'create'])->name('social_worker.form.educational_assistance');
        Route::get('/social_worker/form/AIFCS', [SocialWorkerController::class, 'create'])->name('social_worker.form.AIFCS');


        // List all applications of a specific beneficiary
        Route::get('social_worker/beneficiaries/{beneficiary_id}/application/{application_id?}', [SocialWorkerController::class, 'show'])
            ->name('social_worker.beneficiaries.show');

        //RELEASE ROUTE:

        Route::middleware(['role:social_worker'])->group(function () {
            // Existing routes
            Route::get('/social_worker/manage-release', [SocialWorkerController::class, 'showBatchRelease'])
                ->name('social_worker.showBatchRelease');
            Route::post('/social_worker/manage-release', [SocialWorkerController::class, 'manageRelease'])
                ->name('social_worker.manageRelease');
            Route::post('/social_worker/release-batch/{batch}', [SocialWorkerController::class, 'releaseBatch'])
                ->name('social_worker.releaseBatch');

            Route::patch('/social_worker/update-claim-status/{applicationId}', [SocialWorkerController::class, 'updateClaimStatus'])
                ->name('social_worker.updateClaimStatus');

            // New route for updating beneficiary release
            Route::post('/social_worker/update-beneficiary-release/{beneficiaryId}', [SocialWorkerController::class, 'updateBeneficiaryRelease'])
                ->name('social_worker.updateBeneficiaryRelease');
            Route::post('/social_worker/release/{applicationId}', [SocialWorkerController::class, 'releaseBeneficiary'])->name('social_worker.releaseBeneficiary');
        });
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/beneficiary/update/date_released', [AdminController::class, 'updateDateReleased'])
            ->name('admin.beneficiary.update.date_released');

        // Show beneficiary details with application
        Route::get('/admin/beneficiary/{id}/application/{application_id?}', [AdminController::class, 'show'])
            ->name('admin.beneficiary.show');

        // Update beneficiary application status
        Route::put('/admin/beneficiary/{beneficiary}/application/{application}', [AdminController::class, 'updateBeneficiaryStatus'])
            ->name('admin.beneficiary.update.status');

        Route::get('/print-solo-parent/{id}', [AdminController::class, 'printSoloParentForm'])->name('print.solo.parent');
    });

    Route::prefix('print')->group(function () {
        Route::get('/aifcs/{id}', [PrintController::class, 'printAifcs'])->name('print.aifcs');
        Route::get('/solo-parent/{id}', [PrintController::class, 'printSoloParent'])->name('print.solo.parent');
        Route::get('/senior-citizen/{id}', [PrintController::class, 'printSeniorCitizen'])->name('print.senior.citizen');
        Route::get('/educational-assistance/{id}', [PrintController::class, 'printEducationalAssistance'])->name('print.educational.assistance');
        // Route::get('/print-form/{id}', [PrintController::class, 'printUI'])->name('print.ui');
    });

    Route::group(['prefix' => 'social-worker'], function () {
        // New search route with program_id
        Route::get('/{program_id}/search-beneficiaries', [SocialWorkerController::class, 'searchBeneficiaries'])
            ->name('social_worker.search_beneficiaries');
        Route::get(
            '/{program_id}/beneficiary/{beneficiary_id}/details',
            [SocialWorkerController::class, 'getBeneficiaryDetails']
        )
            ->name('social_worker.beneficiary_details');
    });
});
