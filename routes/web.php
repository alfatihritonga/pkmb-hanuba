<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\ClassAssignmentController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ScoreRecapController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guru\AttendanceController as GuruAttendanceController;
use App\Http\Controllers\Guru\ClassController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\ScoreController;
use App\Http\Controllers\Guru\ScoreRecapController as GuruScoreRecapController;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $authUser = auth()->user();
    if ($authUser) {
        if ($authUser->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($authUser->hasRole('guru')) {
            return redirect()->route('guru.dashboard');
        }
    }

    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

Route::middleware(['auth'])->group(function () {

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('academic-years', AcademicYearController::class);
        Route::resource('grades', GradeController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('teachers', TeacherController::class);

        // route data siswa
        Route::resource('students', StudentController::class)->except(['show']);
        Route::get('students/search', [StudentController::class, 'search'])
            ->name('students.search');

        Route::resource('classrooms', ClassroomController::class);

        Route::get('class-assignments', [ClassAssignmentController::class, 'index'])
            ->name('class-assignments.index');

        Route::post('class-assignments', [ClassAssignmentController::class, 'store'])
            ->name('class-assignments.store');

        Route::delete('class-assignments/{classAssignment}', [ClassAssignmentController::class, 'destroy'])
            ->name('class-assignments.destroy');

        Route::get('students/search', [ClassAssignmentController::class, 'searchStudent'])
            ->name('students.search');

        Route::get('/scores', [ScoreRecapController::class, 'index'])
            ->name('scores.index');

        Route::get('/scores/classroom/{classroom}', [ScoreRecapController::class, 'show'])
            ->name('scores.show');

        Route::get('/scores/classroom/{classroom}/{subject}', [ScoreRecapController::class, 'detail'])
            ->name('scores.detail');

        Route::get('/attendances', [AdminAttendanceController::class, 'index'])
            ->name('attendances.index');

        Route::get('/attendances/classroom/{classroom}', [AdminAttendanceController::class, 'show'])
            ->name('attendances.show');

        Route::get('/attendances/classroom/{classroom}/schedule/{schedule}/{date}', [AdminAttendanceController::class, 'detail'])
            ->where('date', '\\d{4}-\\d{2}-\\d{2}')
            ->name('attendances.detail');

        Route::post('/attendances/classroom/{classroom}/schedule/{schedule}/{date}/validate', [AdminAttendanceController::class, 'validateAttendance'])
            ->where('date', '\\d{4}-\\d{2}-\\d{2}')
            ->name('attendances.validate');

        Route::delete('/attendances/classroom/{classroom}/schedule/{schedule}/{date}/validate', [AdminAttendanceController::class, 'revokeValidation'])
            ->where('date', '\\d{4}-\\d{2}-\\d{2}')
            ->name('attendances.revoke');

        Route::resource('schedules', ScheduleController::class);
        Route::resource('users', UserController::class);
    });

    Route::middleware('role:guru')
        ->prefix('guru')
        ->name('guru.')
        ->group(function () {

        Route::get('/dashboard', [GuruDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/classes', [ClassController::class, 'index'])
            ->name('classes.index');

        Route::get('/classes/{classroom}', [ClassController::class, 'show'])
            ->name('classes.show');

        Route::get('/classes/{classroom}/scores/{subject}', [ScoreController::class, 'create'])
            ->name('scores.create');

        Route::post('/scores', [ScoreController::class, 'store'])
            ->name('scores.store');

        Route::get('/classes/{classroom}/scores/{subject}/recap', [GuruScoreRecapController::class, 'index'])
            ->name('scores.recap');

        Route::prefix('/classes/{classroom}/schedules/{schedule}/attendances')
            ->name('attendances.')
            ->group(function () {
                Route::get('/', [GuruAttendanceController::class, 'index'])
                    ->name('index');
                Route::get('/create', [GuruAttendanceController::class, 'create'])
                    ->name('create');
                Route::post('/', [GuruAttendanceController::class, 'store'])
                    ->name('store');
                Route::get('/{date}/edit', [GuruAttendanceController::class, 'edit'])
                    ->where('date', '\\d{4}-\\d{2}-\\d{2}')
                    ->name('edit');
                Route::put('/{date}', [GuruAttendanceController::class, 'update'])
                    ->where('date', '\\d{4}-\\d{2}-\\d{2}')
                    ->name('update');
            });
    });
});

require __DIR__.'/auth.php';
