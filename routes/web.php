<?php
use App\Http\Controllers\AdminAuthController;

//  Admin Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DistrictController;

//  School Controllers
use App\Http\Controllers\FeeFormatController;
use App\Http\Controllers\FeeRecordController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ItemBankController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\PaperFormatController;

//  Shared / CRUD Controllers
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SchoolAuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TehsilController;
use App\Http\Controllers\ViewResultController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('school.login');
});

// Admin Routes
Route::prefix('admin')->group(function () {

    //  Admin Authentication
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    //  Protected routes (only for logged-in admins)
    Route::middleware(['auth:admin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // CRUD Resource Routes for various entities like Districts, Tehsils, Subjects, Grades, Schools, Students
        Route::resource('districts', DistrictController::class);
        Route::resource('tehsils', TehsilController::class);
        Route::resource('subjects', SubjectController::class)->except(['show', 'create', 'edit']);
        Route::resource('grades', GradeController::class);

        // school managment
        Route::get('schools/filter', [SchoolController::class, 'filter'])->name('schools.filter');
        Route::resource('schools', SchoolController::class);

        // student managment
        // Route::resource('students', StudentController::class);

        //  get tehsils by district AJAX
        Route::get('/get-tehsils', [TehsilController::class, 'getByDistrict'])
            ->name('get.tehsils.by.district');

        // Item Bank Routes
        Route::resource('item-bank', ItemBankController::class);
        Route::get('admin/item-bank/export', [ItemBankController::class, 'export'])->name('item-bank.export');
        Route::post('admin/item-bank/import', [ItemBankController::class, 'import'])->name('item-bank.import');
        Route::get('admin/item-bank/sample-export', [ItemBankController::class, 'sampleExport'])
            ->name('item-bank.sample-export');

    });
});

// School Routes
Route::prefix('school')->group(function () {
    //  School Authentication
    Route::get('/login', [SchoolAuthController::class, 'showLoginForm'])->name('school.login');
    Route::post('/login', [SchoolAuthController::class, 'login'])->name('school.login.post');
    Route::post('/logout', [SchoolAuthController::class, 'logout'])->name('school.logout');

    //  Protected school routes
    Route::middleware(['auth:school'])->group(function () {

        // School Dashboard
        Route::get('/dashboard', [SchoolController::class, 'dashboard'])->name('school.dashboard');

        // Students under the school
        Route::get('students/filter', [StudentController::class, 'filter'])->name('school.students.filter');

        Route::resource('students', StudentController::class)->names([
            'index'   => 'school.students.index',
            'create'  => 'school.students.create',
            'store'   => 'school.students.store',
            'edit'    => 'school.students.edit',
            'update'  => 'school.students.update',
            'show'    => 'school.students.show',
            'destroy' => 'school.students.destroy',
        ]);

        // Paper Format Management
        Route::resource('paper-formats', PaperFormatController::class);

        // School Profile
        Route::get('/profile', [SchoolController::class, 'profile'])->name('school.profile');
        Route::post('/profile/update', [SchoolController::class, 'updateProfile'])->name('school.profile.update');

        // Students under the school
        Route::resource('students', StudentController::class)->names([
            'index'   => 'school.students.index',
            'create'  => 'school.students.create',
            'store'   => 'school.students.store',
            'edit'    => 'school.students.edit',
            'update'  => 'school.students.update',
            'show'    => 'school.students.show',
            'destroy' => 'school.students.destroy',
        ]);

        Route::get('/export-student-sample', [StudentController::class, 'exportSample'])->name('school.students.export.sample');
        Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');

        // Fee Format Management
        Route::get('/fee-formats', [FeeFormatController::class, 'index'])->name('fee-formats.index');
        Route::post('/fee-formats', [FeeFormatController::class, 'store'])->name('fee-formats.store');
        Route::get('/fee-formats/{id}/edit', [FeeFormatController::class, 'edit'])->name('fee-formats.edit');
        Route::put('/fee-formats/{id}', [FeeFormatController::class, 'update'])->name('fee-formats.update');
        Route::delete('/fee-formats/{id}', [FeeFormatController::class, 'destroy'])->name('fee-formats.destroy');

        // add fee
        Route::get('/add-fees', [FeeRecordController::class, 'create'])->name('fees.create');
        Route::post('/fees/store', [FeeRecordController::class, 'store'])->name('fees.store');
        Route::post('/fees/fetch', [FeeRecordController::class, 'fetchStudents'])->name('fees.fetch');
        Route::get('/fees/index', [FeeRecordController::class, 'index'])->name('fees.index');
        Route::delete('/fees/{id}/delete', [FeeRecordController::class, 'destroy'])->name('fees.destroy');
        Route::get('/fees/{id}/view', [FeeRecordController::class, 'show'])->name('fees.view');
        Route::get('/fees/{id}/edit', [FeeRecordController::class, 'edit'])->name('fees.edit');
        Route::put('/fees/{id}/update', [FeeRecordController::class, 'update'])->name('fees.update');

        // Paper Generator
        Route::get('paper-generator', [PaperController::class, 'index'])->name('paper-generator.index');
        Route::post('paper-generator/generate', [PaperController::class, 'generate'])->name('paper-generator.generate');
        Route::post('paper-generator/download-paper', [PaperController::class, 'downloadPaper'])->name('paper-generator.download.paper');
        Route::post('paper-generator/download-key', [PaperController::class, 'downloadAnswerKey'])->name('paper-generator.download.key');

        // Result add Management
        Route::get('/results', [ResultController::class, 'index'])->name('school.results.index');
        Route::post('/results/fetch-paper', [ResultController::class, 'fetchPaper'])->name('school.results.fetchPaper');
        Route::post('/results/store', [ResultController::class, 'store'])->name('school.results.store');

        // view result routes
        Route::get('view-results/', [ViewResultController::class, 'view'])->name('school.results.view');
        Route::get('view-results/filter', [ViewResultController::class, 'filter'])->name('school.results.filter');
        Route::get('view-results/grade/{grade}', [ViewResultController::class, 'studentsByGrade'])->name('school.results.grade');
        Route::get('view-results/student/{student}/dmc', [ViewResultController::class, 'viewDMC'])->name('school.results.dmc');
        Route::get('/view-results/dmc/{studentId}/download', [ViewResultController::class, 'downloadDMC'])->name('school.results.dmc.download');

    });
});
